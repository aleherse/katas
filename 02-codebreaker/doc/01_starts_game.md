## Feature: Code-breaker starts game

Let's face the first step `I am not yet playing`, this step is useful because is putting the scenario in context
but there is no logic we can add, so we'll remove the exception and leave the method empty.

    public function iAmNotYetPlaying()
    {
    }

If we run behat we'll see our first step passing (in green)

    bin/behat features/code-breaker_starts_game.feature
