Fragment of code created during the London Code Dojo meetup 33
 * slides: https://speakerdeck.com/sleepyfox/code-dojo-33 
 * event: http://www.meetup.com/London-Code-Dojo/events/222393947/

# Kata: That's a wrap
As part of a text editor application, write a function or method that takes:
 * A string of text (potentially long), and
 * A number of columns
 
It returns the same string, with newlines at or before the column length, placed if possible at word boundaries.

# How to execute the tests
    cd that_is_a_wrap
    composer install    
    bin/phpspec run --format=pretty
