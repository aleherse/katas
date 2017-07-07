<?php


class StringCalculator
{
    const REGULAR_EXPRESSION = '/(\d+|\+|\-|\*|\/|\^)\s*/';

    private $operations;

    public function __construct()
    {
        $this->operations = [
           '+' => ['precedence' => 2, 'operation' => function ($a, $b) { return $a + $b; }],
           '-' => ['precedence' => 2, 'operation' => function ($a, $b) { return $a - $b; }],
           '*' => ['precedence' => 3, 'operation' => function ($a, $b) { return $a * $b; }],
           '/' => ['precedence' => 3, 'operation' => function ($a, $b) { return $a / $b; }],
           '^' => ['precedence' => 4, 'operation' => function ($a, $b) { return pow($a, $b); }],
        ];
    }

    public function calculate(string $expression): float
    {
        if (empty($expression)) {
            return 0.0;
        }

        return $this->resolveReversePolishNotation(
            $this->buildReversePolishNotation(
                $this->extractElements($expression)
            )
        );
    }

    private function extractElements(string $expression): array
    {
        $elements = [];
        preg_match_all(self::REGULAR_EXPRESSION, $expression, $elements);

        return $elements[1];
    }

    private function buildReversePolishNotation(array $elements): array
    {
        $rpn = [];
        $operators = new \Ds\Stack();
        foreach ($elements as $element) {
            if (isset($this->operations[$element])) {
                while (!$operators->isEmpty() && $this->precedence($operators->peek()) >= $this->precedence($element)) {
                    $rpn[] = $operators->pop();
                }

                $operators->push($element);
            } else {
                $rpn[] = (float) $element;
            }
        }

        while (!$operators->isEmpty()) {
            $rpn[] = $operators->pop();
        }

        return $rpn;
    }

    private function resolveReversePolishNotation(array $rpn): float
    {
        $stack = new \Ds\Stack();
        foreach ($rpn as $element) {
            if (isset($this->operations[$element])) {
                $b = $stack->pop();
                $a = $stack->pop();

                $stack->push($this->operate($element, $a, $b));
            } else {
                $stack->push($element);
            }
        }

        return $stack->pop();
    }

    private function precedence(string $element): int
    {
        return $this->operations[$element]['precedence'];
    }

    private function operate(string $operation, float $a, float $b): float
    {
        return $this->operations[$operation]['operation']($a, $b);
    }
}
