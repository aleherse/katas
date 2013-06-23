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
    /** @var  Greeter $greeter */
    private $greeter;

    private $greet;

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
     * @Given /^a greeter$/
     */
    public function aGreeter()
    {
        $this->greeter = new Greeter();
    }

    /**
     * @When /^I send it the greet message$/
     */
    public function iSendItTheGreetMessage()
    {
        $this->greet = $this->greeter->greet();
    }

    /**
     * @Then /^I should see "([^"]*)"$/
     */
    public function iShouldSee($greet)
    {
        return $this->greet === $greet;
    }
}
