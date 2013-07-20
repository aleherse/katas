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
