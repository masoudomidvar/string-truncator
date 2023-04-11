<?php

namespace StringTruncator\Truncator;

require_once 'Shared/Transfer/StringTruncatorTransfer.php';

use Shared\Transfer\StringTruncatorTransfer;

interface StringTruncatorInterface
{
    /**
     * @param \Shared\Transfer\StringTruncatorTransfer $stringTruncatorTransfer
     *
     * @return string
     */
    public function truncateString(StringTruncatorTransfer $stringTruncatorTransfer): string;
}
