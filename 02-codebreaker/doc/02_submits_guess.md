## Feature: Code-breaker submits guess

You can review the feature file in this link [features/code-breaker_submits_game.feature](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/features/features/code-breaker_submits_game.feature) and these is the explanation of some new keywords that are present in the file

The first of them is **Scenario Outline** and it is use to express more concisely examples that use different values in this case the placeholders are within `< >`

The second keyword is **Examples** and it has inside a table the values that are going to be used inside each placeholder

Now that we understand the feature file it's time to face the first step `the secret code is "<code>"`, so lets add this code to the `FeatureContext` file

    public function theSecretCodeIs($secret)
    {
        $this->command = (new CodebreakerCommand())
            ->setSecret($secret);
    }

If we run behat we will find a fatal error becouse `setSecret` method is undefined but that is the expected outcome, we will define it later using phpspec

    bin/behat features/code-breaker_submits_guess.feature

For the next step we need to change to phpspec and create the behaviour the command should set a secret inside the `CodebreakerCommandSpec` class

    function it_should_set_a_secret()
    {
        $this->setSecret('1234');
        $this->getSecret()->shouldReturn('1234');
    }

Now if we run phpspec several time it will create the method `setSecret` and `getSecret` and finally we will have a failing example

    bin/phpspec run spec/Aleherse/Codebreaker/CodebreakerCommandSpec.php

And making this example pass is as easy is add these lines to the `CodebreakerCommand` class

    protected $secret = '0000';

    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

If we run phpspec now the example is passing but also if we run behat we find that 14 steps are passing, this is because the first step is also the first in the 14 scenarios

First step done, lets move to the second one `I guess "<guess>"`, the code we need to add is very simple

    public function iGuess($guess)
    {
        $this->command->guess($guess);
    }

And like with the previous one we encounter a fatal error so it's time to change to phpspec again and add this behaviour to the `CodebreakerCommand`

    function it_should_receive_a_guess()
    {
        $this->guess('5555');
    }

Like before running phpspec two times will create the `guess` method and as different from the previous step this time the example is passing without adding any code and also the second step in behat is passing

Maybe this situation looks weird at first because the step is passing but we didn't actually add any code, but it's ok that was the intended behaviour
