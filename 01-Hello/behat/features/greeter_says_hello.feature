# features/greeter_says_hello.feature
Feature: greeter says hello
  In order to start learning Behat
  As a trainee
  I want a greeter to say "Hello world!"

Scenario: greeter says hello
  Given a greeter
  When I send it the greet message
  Then I should see "Hello world!"