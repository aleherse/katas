# Codebreaker

Codebraker is a project extracted from the book [The RSpec Book: Behaviour Driven Development with Rspec, Cucumber, and Friends](http://www.amazon.com/RSpec-Book-Behaviour-Development-Cucumber/dp/1934356379)

You can find all the steps of the development process walking through the sequence of commits.

We will develop this application in several iteration, each of them with its own file describing the followed steps.

 * [Iteration 01](https://github.com/aleherse/katas-BDD/tree/master/02-codebreaker/iteration-01.md): start a game and submit a guess.

## Introducing codebreaker

Codebreaker is a logic game in which a code-breaker tries to break a secret code created by a code-maker. The code-maker, which will be played by the application we’re going to write, creates a secret code of four numbers between 1 and 6.

The code-breaker then gets some number of chances to break the code. In each turn, the code-breaker makes a guess of four numbers (again, 1 to 6). The code-maker then marks the guess with up to four + and - signs.

A + indicates an exact match: one of the numbers in the guess is the same as one of the numbers in the secret code and in the same position.

A - indicates a number match: one of the numbers in the guess is the same as one of the numbers in the secret code but in a different position.

For example, given a secret code 1234, a guess with 4256 would earn a +-. The + is for the 2 in the second position in the guess, which matches the 2 in the secret code in both number and position: an exact match. The - is for the 4 in the first position in the guess, which matches the 4 in the code but not in the same position: a number match.

The plus signs for the exact matches always come before the minus signs for the number matches and don’t align with specific positions in the guess or the secret code.

## Features for the first release

### Code-breaker starts game

The code-breaker opens a shell, types a command, and sees a welcome message and a prompt to enter the first guess.

### Code-breaker submits guess

The code-breaker enters a guess, and the system replies by marking the guess according to the marking algorithm.

### Code-breaker wins game

The code-breaker enters a guess that matches the secret code exactly. The system responds by marking the guess with four + signs and a message congratulating the code-breaker on breaking the code in however many guesses it took.

### Code-breaker loses game

After some number of turns, the game tells the code-breaker that the game is over (need to decide how many turns and whether to reveal the code).

### Code-breaker plays again

After the game is won or lost, the system prompts the code-breaker to play again. If the code-breaker indicates yes, a new game begins. If the code-breaker indicates no, the system shuts down.

### Code-breaker requests hint

At any time during a game, the code-breaker can request a hint, at which point the system reveals one of the numbers in the secret code.

### Code-breaker saves score

After the game is won or lost, the code-breaker can opt to save information about the game: who (initials?), how many turns, and so on.

