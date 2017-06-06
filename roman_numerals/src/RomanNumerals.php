<?php

class RomanNumerals
{

    public function fromArabic($arabic)
    {
        $glyphs = [
            10 => 'X',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];
        
        $roman = '';
        foreach ($glyphs as $decimal => $glyph) {
            while ($arabic >= $decimal) {
                $roman .= $glyph;
                $arabic -= $decimal;
            }
        }
        
        return $roman;
    }
}
