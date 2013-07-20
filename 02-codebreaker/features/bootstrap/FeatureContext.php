<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

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
        throw new PendingException();
    }

    /**
     * @When /^I start a new game$/
     */
    public function iStartANewGame()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the secret code is "([^"]*)"$/
     */
    public function theSecretCodeIs($arg1)
    {
        throw new PendingException();
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
