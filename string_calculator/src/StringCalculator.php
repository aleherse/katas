<?php

use Ds\Queue;
use Ds\Stack;

class StringCalculator
{
    const REGULAR_EXPRESSION = '/(\d+|\+|\-|\*|\/|\^)\s*/';

    private $operations;

    public function __construct()
    {
        $binary = function (callable $operation, Stack $stack) {
            $b = $stack->pop();
            $a = $stack->pop();

            return $operation($a, $b);
        };

        $this->operations = [
            '+' => function (Stack $stack) use ($binary) {
                return $binary(function ($a, $b) { return $a + $b; }, $stack);
            },
            '-' => function (Stack $stack) use ($binary) {
                return $binary(function ($a, $b) { return $a - $b; }, $stack);
            },
            '*' => function (Stack $stack) use ($binary) {
                return $binary(function ($a, $b) { return $a * $b; }, $stack);
            },
            '/' => function (Stack $stack) use ($binary) {
                return $binary(function ($a, $b) { return $a / $b; }, $stack);
            },
            '^' => function (Stack $stack) use ($binary) {
                return $binary(function ($a, $b) { return pow($a, $b); }, $stack);
            },
        ];

        $this->precedence = [
            '+' => 2,
            '-' => 2,
            '*' => 3,
            '/' => 3,
            '^' => 4,
        ];
    }

    public function calculate(string $operation): float
    {
        if (empty($operation)) {
            return 0.0;
        }

        $elements = $this->extractOperationElements($operation);
        $rpn = $this->createReversePolishNotation($elements);

        return $this->processReversePolishNotation($rpn);
    }

    /**
     * @param string $operation
     *
     * @return array
     */
    private function extractOperationElements(string $operation): array
    {
        $elements = [];
        preg_match_all(self::REGULAR_EXPRESSION, $operation, $elements);

        return $elements[1];
    }

    /**
     * @param $rpn
     *
     * @return mixed
     */
    private function processReversePolishNotation(Queue $rpn)
    {
        $output = new Stack();
        while (!$rpn->isEmpty()) {
            if (isset($this->operations[$rpn->peek()])) {
                $output->push($this->operations[$rpn->pop()]($output));
            } else {
                $output->push($rpn->pop());
            }
        }

        return $output->pop();
    }

    /**
     * @param $elements
     *
     * @return Queue
     */
    private function createReversePolishNotation($elements): Queue
    {
        $operators = new Stack();
        $rpn = new Queue();
        foreach ($elements as $element) {
            if (isset($this->operations[$element])) {
                while(!$operators->isEmpty() && $this->precedence[$operators->peek()] >= $this->precedence[$element]) {
                    $rpn->push($operators->pop());
                }

                $operators->push($element);
            } else {
                $rpn->push((float) $element);
            }
        }

        while (!$operators->isEmpty()) {
            $rpn->push($operators->pop());
        }

        return $rpn;
    }
}
