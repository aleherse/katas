<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Symfony\Component\Console\Tester\ApplicationTester;
use Aleherse\Codebreaker\CodebreakerApplication,
    Aleherse\Codebreaker\CodebreakerCommand;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /** @var  ApplicationTester $applicationTester */
    protected $applicationTester;

    /** @var CodebreakerCommand $command */
    protected $command;

    /** @var  string[] $display */
    protected $display = [];

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @Given /^I am not yet playing$/
     */
    public function iAmNotYetPlaying()
    {
    }

    /**
     * @When /^I start a new game$/
     */
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

    protected function getDisplayLine()
    {
        if (null === $this->display) {
            $this->display = explode("\n",$this->applicationTester->getDisplay());
        }

        return array_shift($this->display);
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($message)
    {
        $displayLine = $this->getDisplayLine();
        if ($displayLine != $message) {
            throw new Exception(sprintf('Expected message %s but got %s', $message, $displayLine));
        }
    }

    /**
     * @Given /^the secret code is "([^"]*)"$/
     */
    public function theSecretCodeIs($secret)
    {
        $this->command = (new CodebreakerCommand())
            ->setSecret($secret);
    }

    /**
     * @When /^I guess "([^"]*)"$/
     */
    public function iGuess($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^the mark should be "([^"]*)"$/
     */
    public function theMarkShouldBe($arg1)
    {
        throw new PendingException();
    }
}
