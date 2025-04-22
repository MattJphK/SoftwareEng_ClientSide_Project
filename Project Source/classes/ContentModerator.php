<?php
class ContentModeration
{
    private $blacklist = ["fuck", "shit", "fucker", "shitty", "bullshit"];

    public function filterWords($text)
    {
        $text = strtolower($text);
        $chars = str_split($text);
        $currentWord = '';
        $words = [];

        //Split words
        foreach ($chars as $char) {
            if (!in_array($char, [' ', '!', '.', '?', ',', ';', ':', '-', '_', '(', ')', '[', ']', '{', '}', '"', "'", "\n", "\r", "\t"])) {
                $currentWord .= $char;
            } else {
                if ($currentWord !== '') {
                    $words[] = $currentWord;
                    $currentWord = '';
                }
                $words[] = $char;
            }
        }

       //filter words
        if ($currentWord !== '') {
            $words[] = $currentWord;
        }

        for ($i = 0; $i < count($words); $i++) {
            foreach ($this->blacklist as $blacklistWord) {
                if ($words[$i] === $blacklistWord) {
                    $words[$i] = str_repeat('*', strlen($blacklistWord));
                }
            }
        }

        $filteredText = '';

        //join words
        foreach ($words as $word) {
            $filteredText .= $word;
        }
        return $filteredText;
    }
}
