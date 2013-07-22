Feature: code-breaker submits guess
  In order to submit a guess
  As a code-breaker
  I need to enter in the application a four number guess
  and the game will return a mark with + and - signs
  For each number in the guess that matches the number and position of a number in the secret code, the mark includes one + sign
  For each number in the guess that matches the number but not the position of a number in the secret code, the mark includes one - sign

Scenario Outline: no matches
  Given the secret code is "<code>"
  When I guess "<guess>"
  Then the mark should be "<mark>"
  Examples:
    | code | guess | mark |
    | 1234 | 5555  |      |

Scenario Outline: 1 number correct
  Given the secret code is "<code>"
  When I guess "<guess>"
  Then the mark should be "<mark>"
  Examples:
    | code | guess | mark |
    | 1234 | 1555  | +    |
    | 1234 | 2555  | -    |

Scenario Outline: 2 numbers correct
  Given the secret code is "<code>"
  When I guess "<guess>"
  Then the mark should be "<mark>"
  Examples:
    | code | guess | mark |
    | 1234 | 5254  | ++   |
    | 1234 | 5154  | +-   |
    | 1234 | 2545  | --   |

Scenario Outline: 3 numbers correct
  Given the secret code is "<code>"
  When I guess "<guess>"
  Then the mark should be "<mark>"
  Examples:
    | code | guess | mark |
    | 1234 | 5234  | +++  |
    | 1234 | 5231  | ++-  |
    | 1234 | 5124  | +--  |
    | 1234 | 5123  | ---  |

Scenario Outline: all numbers correct
  Given the secret code is "<code>"
  When I guess "<guess>"
  Then the mark should be "<mark>"
  Examples:
    | code | guess | mark |
    | 1234 | 1234  | ++++ |
    | 1234 | 1243  | ++-- |
    | 1234 | 1423  | +--- |
    | 1234 | 4321  | ---- |