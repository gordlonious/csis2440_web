<?php
class PostValidation
{
    public static function year_dash($str)
    {
        $strArray = str_split($str);

        if (count($strArray) < 5)
        {
            return false;
        }

        for ($i = 0; $i < 5; $i++)
        {
            $c = $strArray[$i];

            if ($i < 4)
            {
                // the first three characters should be a 1+ integer, the fourth character can be 0-9, and the 5th character should be dash
                $yearDigit = intval($c);

                if ($yearDigit == 0)
                {
                    // using intval does not allow me to differentiate between 0 and something that is not a number
                    if ($i == 3)
                    {
                        continue;
                    }
                    return false;
                }
            }
            else
            {
                if ($c != '-')
                {
                    return false;
                }
            }
        }

        return true;
    }
}
?>
