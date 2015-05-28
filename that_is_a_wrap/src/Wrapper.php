<?php

class Wrapper
{

    public function wrap($text, $columns)
    {
        $wrappedText = $this->splitAtColumn($text, $columns);

        return implode("\n",$wrappedText);
    }

    /**
     * @param $text
     * @param $columns
     * @return array
     */
    protected function splitAtColumn($text, $columns)
    {
        $wrappedText = array('');
        if ($columns != 0) {
            if ($columns >= strlen($text)) {
                $wrappedText = array($text);
            } else {
                $tempText = $this->splitTextAt($text, $columns);
                $wrappedText = array_merge(
                    array($tempText[0]),
                    $this->splitAtColumn($tempText[1], $columns)
                );
            }
        }
        return $wrappedText;
    }

    /**
     * @param $text
     * @param $columns
     * @return string
     */
    protected function splitTextAt($text, $columns)
    {
        $firstPart = trim(substr($text, 0, $columns));
        if (isset($text[$columns]) && $text[$columns] == ' ') {
            return array($firstPart, trim(substr($text, $columns)));
        } else if($pos = strrpos($firstPart, ' ')) {
            return array(trim(substr($text, 0, $pos)), trim(substr($text, $pos)));
        } else {
            return array(trim(substr($text, 0, $columns)), trim(substr($text, $columns)));
        }
    }
}
