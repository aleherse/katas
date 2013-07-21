# Iteration 01

To produce a minimum viable project the features we are going to develop are:

 * Code-breaker starts game
 * Code-breaker submits guess

The first thing we should do is install behat and phpspec using [composer](http://getcomposer.org/), so this is the content we need to write in the `composer.json` file

    {
        "require": {
            "behat/behat": "2.4.*@stable",
            "phpspec/phpspec": "2.0.*@dev"
        },

        "config": {
            "bin-dir": "bin/"
        },
        "autoload": {"psr-0": {"": "src"}}
    }

And now we only need to run the next command to download all the needed libraries

    composer install

The next step is initialize behat letting it create the files and folders it needs to work

    bin/behat --init

Now is time to write the features for this iteration inside the features folder

 * [features/code-breaker_starts_game.feature](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/features/code-breaker_starts_game.feature)
 * [features/code-breaker_submits_game.feature](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/features/features/code-breaker_submits_game.feature)

At this time if we run behat we'll see our scenarios and a summary of the execution saying 15 undefined scenarios and 46 undefined steps

    bin/behat --no-snippets

It is time to work in those undefined scenarios and steps, so we'll run behat asking it to do some of work for us creating the snippets of code

    bin/behat --append-snippets

If we execute the last command again we'll see that now we have 15 pending scenarios, 31 steps skipped and 15 steps pending.
What have happened is that behat have created one method for each step in the featureContext.php file and setting them to pending implementation.

The followed steps for each feature can be read on these files inside the doc folder

 * [Code-breaker starts game](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/doc/01_starts_game.md)
 * [Code-breaker submits guess](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/doc/02_submits_guess.md)