# Kata: String Calculator

Write a function that receives a string with a mathematical operation and returns its result as a decimal number.

For the sake of simplicity we are going to suppose that the function is going to receive always a well formed operation, 
that there is going to be just one blank space between its elements and that all the numbers are going to be natural numbers.

The requirements are:

 * It returns 0 if the operation is empty
 * It returns the number it the operation contains just a number
 * It supports addition (3 + 2 = 5.0)
 * It supports subtraction (4 - 1 = 3.0)
 * It supports more than one operation (3 + 2 - 1 + 8 = 12.0)
 * It supports multiplication (3 * 2 = 6.0)
 * It supports operation precedence (2 + 3 * 4 = 3 * 4 + 2 = 14.0)
 * It supports division (6 / 2 = 3.0)
 * It supports exponential (6 ^ 3 = 216.0)
 * It supports a complex operation (1 + 3 + 4 * 2 / 5 ^ 2 * 4 * 7 + 6 = 18.96)

# How to execute the tests

```bash
composer install    
bin/phpspec run --format=pretty
```
