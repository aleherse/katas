## Feature: Code-breaker starts game

Let's face the first step `I am not yet playing`, this step is useful because is putting the scenario in context
but there is no logic we can add, so we'll remove the exception and leave the method empty.

    public function iAmNotYetPlaying()
    {
    }

If we run behat we'll see our first step passing (in green)

    bin/behat features/code-breaker_starts_game.feature

This was a really easy step, now is time to face the second one `I start a new game`, before anything we need to decide how Codebreaker is going to be played.
To keep this example simple Codebreaker is going to be a command line application and we are going to use the Console component of the Symfony framework [link](https://github.com/symfony/Console).

So we need to add the next line to the requiere section of the `composer.json` file

    "symfony/console": "2.4.*@dev"

and update composer

    composer update

This step should create an instance of `CodebreakerApplication` class and starts a game so we'll remove the exception and add some code to the `iStartANewGame()` method in the `FeatureContext.php` file.

	use Symfony\Component\Console\Tester\ApplicationTester;
	use Aleherse\Codebreaker\CodebreakerApplication;

    public function iStartANewGame()
    {
		/** @var CodebreakerApplication $application */
		$application = new CodebreakerApplication();
		$application->setAutoExit(false);

		$applicationTester = new ApplicationTester($application);

		$returnValue = $applicationTester->run([]);

		if ($returnValue > 0) {
			throw new Exception('Codebreaker returned an unexpected value while starting a new game');
		}
    }

If we execute behat we see a fatal error, we have jumped into a failing step it's time to change to phpspec, we need to execute the next command to create the specification file for the `CodebreakerApplication` class

    bin/phpspec desc Aleherse/Codebreaker/CodebreakerApplication

Executing the next line we check all the specification files, the first time executing phpspec we'll be asked if we want to create the class, answer yes.

    bin/phpspec run

Next time executing the previous command we see a green bar. Now we need to make our class to be a console application, to accomplish that we add the next method to the specification file

    function it_should_be_a_console_application()
    {
        $this->shouldBeAnInstanceOf('Symfony\Component\Console\Application');
    }

If we run phpspec now we find a failing example. To change it into a passing example we need to make `CodebreakerApplication` extend the `Application` class.

    use Symfony\Component\Console\Application;

    class CodebreakerApplication extends Application
    {
    }

And now if we run behat we can check that the `I start a new game` step is passing.

Two steps down, lets go for the third one `I should see "Welcome to Codebreaker!"` the phrase "Welcome to Codebreaker!" is between
quotation mark because Behat is going to consider it as an argument for the `iShouldSee` method, but before anything we need to refactor
the `FeatureContext` class because we need to access to the `applicationTester` object from the `iShouldSee` method

    /** @var  ApplicationTester $applicationTester */
    protected $applicationTester;

    public function iStartANewGame()
    {
        /** @var CodebreakerApplication $application */
        $application = new CodebreakerApplication();
        $application->setAutoExit(false);

        $this->applicationTester = new ApplicationTester($application);

        $returnValue = $this->applicationTester->run([]);

        if ($returnValue > 0) {
            throw new Exception('Codebreaker returned an unexpected value while starting a new game');
        }
    }

If we run behat and phpspec we can check that we haven't introduce any error and the steps and examples are still passing

It's time to add the logic that we need for the method `iShouldSee`

    public function iShouldSee($message)
    {
        $display = $this->applicationTester->getDisplay();

        if ($display != $message) {
            throw new Exception(sprintf('Expected message %s but got %s', $message, $display));
        }
    }

If we run Behat again we find one failing step so it is time to specify the behaviour of the application.

We don't want to pass any argument to the codebreaker command so we need to create a console application with one default command, to accomplish this we can follow this [cookbook](http://symfony.com/doc/current/components/console/single_command_tool.html) entry. But before copy and paste the code we need to specify the changes in the command class behaviour to accomplish that, so lets start adding this method to the `CodebreakerApplicationSpec` file

    use Symfony\Component\Console\Input\InputInterface;

    function it_should_return_codebreaker_as_command_name(InputInterface $input)
    {
        $this->getCommandName($input)->shouldReturn('codebreaker');
    }

Running phpspec now it will ask us to create the `getCommandName` method, answer yes. Now if we execute phpspec again we end with a failing example.

If we change the getCommandName method to this we will find a passing example

    use Symfony\Component\Console\Input\InputInterface;

    public function getCommandName(InputInterface $input)
    {
        return 'codebreaker';
    }
