<?php

class CoverImageTitleFilter
{
    public static function titleFilter($title)
    {
        $title = strtolower($title);
        $coverImage = '';

        for ($i = 0; $i < strlen($title); $i++) {
            $char = $title[$i];

            if ($char === ' ') {
                $coverImage .= '_';
            } elseif (
                ($char >= 'a' && $char <= 'z') ||
                ($char >= '0' && $char <= '9') ||
                $char === '_'
            ) {
                $coverImage .= $char;
            }
        }

        return $coverImage . '.jpg';
    }
}
