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

So lets move to the third step `the mark should be "<mark>"` and everything will make sense.

In this step we need to check the mark and the mark depends on the guess so the expected behaviour is that the method `guess` should return the calculated mark, so we need to refactor the `iGuess` method in `FeatureContext` class

    protected $mark;

    public function iGuess($guess)
    {
        $this->mark = $this->command->guess($guess);
    }

Executing behat and phpspec we'll see that everything is working as before so we didn't introduce any error, great

Thanks to the refactor now we can check the returned mark in the `theMarkShouldBe` method and the code to do that is

    public function theMarkShouldBe($mark)
    {
        if($mark !== $this->mark) {
            throw new Exception(sprintf('Expected mark %s but got %s', $mark, $this->mark));
        }
    }

If we run behat we have 14 failing scenarios because of this third step, so lets move again to phpspec

But now this is not a trivial example because depending on the guess we have different resulting marks and of course different scenarios to choose, so the best practice here is going to the easiest scenario

In this case it is the no matches scenario so the expected behaviour is that `guess` should return an empty mark with no matches and this is the example

    function it_returns_an_empty_mark_with_a_guess_with_no_matches()
    {
        $this->setSecret('1234');
        $this->guess('5555')->shouldReturn('');
    }

As expected the example is failing, to make it pass we only need to return an empty string in the `guess` method of `CodebreakerCommand`

    public function guess($guess)
    {
        return '';
    }

So now 1 scenario out of 14 is working, the next easier scenario is when one number is correct because of a number match and this is the behaviour we are expecting

    function it_returns_a_minus_mark_with_a_guess_with_one_number_match()
    {
        $this->setSecret('1234');
        $this->guess('25555')->shouldReturn('-');
    }

As always the example is failing an to make it pass the logic we need is

    public function guess($guess)
    {
        $mark = '';

        if (strpos($this->getSecret(), $guess[0])) {
            $mark .= '-';
        } else {
            $mark .= '';
        }

        return $mark;
    }

I am sure you know a better implementation of the algorithm or at least something to make it pass several scenario at once, but the objective of BDD is do the minimun effort to make the actual step/example pass. My point here is that as you get experience in this methodology if you are confidence enough you can make bigger and bigger steps

With the previous code all the phpspec examples are working and in behat we have 2 scenarios out of 14 running

It's time to move to the behaviour when we find an exact match and then test that the example is failing

    function it_returns_a_plus_mark_with_a_guess_with_one_exact_match()
    {
        $this->setSecret('1234');
        $this->guess('15555')->shouldReturn('+');
    }

The modification of the `guess` method to make the example pass is the next one and after the change we also have 3 scenarios out of 14 working

    public function guess($guess)
    {
        $mark = '';

        if (0 === strpos($this->getSecret(), $guess[0]) ) {
            $mark .= '+';
        } else if (0 < strpos($this->getSecret(), $guess[0]) ) {
            $mark .= '-';
        }

        return $mark;
    }

We are on fire but before moving to another scenario it's time to refactor our code a bit because the method `guess` is getting bigger so lets rewrite it to this

    public function guess($guess)
    {
        $mark = '';

        if ($this->exactMatch($guess, 0)) {
            $mark .= '+';
        } elseif ($this->numberMatch($guess, 0)) {
            $mark .= '-';
        }

        return $mark;
    }

    protected function exactMatch($guess, $index)
    {
        return $this->getSecret()[$index] == $guess[$index];
    }

    protected function numberMatch($guess, $index)
    {
        return false !== strpos($this->getSecret(), $guess[$index]);
    }

Now the intention behind the `guess` method is really clear reading the actual code and also the scenarios and examples are working as before

lets go for the next easier scenario, it has to return two minus marks with two numbers match

    function it_returns_2_minus_marks_with_a_guess_with_2_number_match()
    {
        $this->setSecret('1234');
        $this->guess('2355')->shouldReturn('--');
    }

To make this example pass we only need to modify the `guess` method to iterate through all the numbers of the guess

    public function guess($guess)
    {
        $mark = '';

        for ($i = 0; $i < 4; $i++) {
            if ($this->exactMatch($guess, $i)) {
                $mark .= '+';
            } elseif ($this->numberMatch($guess, $i)) {
                $mark .= '-';
            }
        }

        return $mark;
    }

To our surprise we have jumped from 3 scenarios out 14 to eleven passing scenarios

It is time to see why we have three failing scenarios left, if we read the error message `Expected mark +-- but got --+` we can easily see that our solution is given the correct mark but not in the expected order so lets write a new example the ammend the problem

    function it_returns_a_plus_and_a_minus_mark_with_a_number_match_and_an_exact_match()
    {
        $this->setSecret('1234');
        $this->guess('2535')->shouldReturn('+-');
    }

We can make this example pass checking for the exact match before and then for the number match and concatenate the results

    public function guess($guess)
    {
        $mark = '';

        for ($i = 0; $i < 4; $i++) {
            if ($this->exactMatch($guess, $i)) {
                $mark .= '+';
            }
        }

        for ($i = 0; $i < 4; $i++) {
            if ($this->numberMatch($guess, $i)) {
                $mark .= '-';
            }
        }

        return $mark;
    }

But the example is still failing and also now we have go down to 5 scenario out of 14. So lets see what is happening The error message is `expected "+-", but got "+--"`, we now realize that the problem is that an exact match is also counted as a number match so we need to rewrite the `numberMatch` method to not return a mark if it is also an exact match

    protected function numberMatch($guess, $index)
    {
        $pos = strpos($this->getSecret(), $guess[$index]);

        return false !== $pos && $pos != $index;
    }

Great now all the examples and scenarios are passing!

Now we can refactor several times and after each modification run behat and phpspec the check if everything is working as expected

The first refactor we can do is clarify the nature of the guess method

    public function guess($guess)
    {
        $exactMatchCount = 0;
        $numberMatchCount = 0;

        for ($i = 0; $i < 4; $i++) {
            if ($this->exactMatch($guess, $i)) {
                $exactMatchCount++;
            }
        }

        for ($i = 0; $i < 4; $i++) {
            if ($this->numberMatch($guess, $i)) {
                $numberMatchCount++;
            }
        }

        return str_repeat('+', $exactMatchCount) . str_repeat('-', $numberMatchCount);
    }

With the second refactor we can extract some methods

    public function guess($guess)
    {
        $exactMatchCount = $this->exactMatchCount($guess);
        $numberMatchCount = $this->numberMatchCount($guess);

        return str_repeat('+', $exactMatchCount) . str_repeat('-', $numberMatchCount);
    }

    protected function numberMatchCount($guess)
    {
        $numberMatchCount = 0;

        for ($i = 0; $i < 4; $i++) {
            if ($this->isNumberMatch($guess, $i)) {
                $numberMatchCount++;
            }
        }

        return $numberMatchCount;
    }

    protected function exactMatchCount($guess)
    {
        $exactMatchCount = 0;

        for ($i = 0; $i < 4; $i++) {
            if ($this->isExactMatch($guess, $i)) {
                $exactMatchCount++;
            }
        }

        return $exactMatchCount;
    }

    protected function isExactMatch($guess, $index)
    {
        return $this->getSecret()[$index] == $guess[$index];
    }

    protected function isNumberMatch($guess, $index)
    {
        $pos = strpos($this->getSecret(), $guess[$index]);

        return false !== $pos && $pos != $index;
    }
