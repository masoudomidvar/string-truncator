<?php

namespace StringTruncator;

require_once 'Truncator/StringTruncator.php';
require_once 'Truncator/StringTruncatorInterface.php';

use StringTruncator\Truncator\StringTruncator;
use StringTruncator\Truncator\StringTruncatorInterface;

class StringTruncatorFactory
{
    /**
     * @return \StringTruncator\Truncator\StringTruncatorInterface
     */
    public function createStringTruncator(): StringTruncatorInterface
    {
        return new StringTruncator();
    }
}
