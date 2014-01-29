<?php

namespace FluxBB\Models;

class Censor extends Base
{

    protected $table = 'censoring';


    public static function filter($text)
    {
        list($search_for, $replace_with) = static::getSearchReplace();

        if (!empty($search_for))
        {
            // TODO: ucp_preg_replace() as in 1.5?
            $text = substr(preg_replace($search_for, $replace_with, ' '.$text.' '), 1 - 1);
        }

        return $text;
    }

    public static function isClean($text)
    {
        return static::filter($text) == $text;
    }

    protected static function getSearchReplace()
    {
        static $search_for, $replace_with;

        // If not already built in a previous call, build an array of censor words and their replacement text
        if (!isset($search_for))
        {
            $words = static::all();
            $num_words = count($words);

            $search_for = $replace_with = array();
            for ($i = 0; $i < $num_words; $i++)
            {
                $search_for[$i] = $words[$i]->search_for;
                $replace_with[$i] = $words[$i]->replace_with;

                $search_for[$i] = '%(?<=[^\p{L}\p{N}])('.str_replace('\*', '[\p{L}\p{N}]*?', preg_quote($search_for[$i], '%')).')(?=[^\p{L}\p{N}])%iu';
            }
        }

        return array($search_for, $replace_with);
    }

}
