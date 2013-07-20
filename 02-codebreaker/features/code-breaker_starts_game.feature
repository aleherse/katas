Feature: Code-breaker starts game
  In order to start breaking the code
  As a code-breaker
  I need to start the game

Scenario: Start game
  Given I am not yet playing
  When I start a new game
  Then I should see "Welcome to Codebreaker!"
  And I should see "Enter guess:"
