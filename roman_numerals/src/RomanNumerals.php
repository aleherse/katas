<?php

class RomanNumerals
{
    public function fromArabic(int $decimal): string
    {
        $glyphs = [
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];

        $roman = '';
        foreach ($glyphs as $number => $glyph) {
            while ($decimal >= $number) {
                $roman .= $glyph;
                $decimal -= $number;
            }
        }

        return $roman;
    }
}
