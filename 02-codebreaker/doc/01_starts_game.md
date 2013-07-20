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

Next time executing the previous command we see a green bar.