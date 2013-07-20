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
