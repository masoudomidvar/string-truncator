<?php

namespace StringTruncator;

require_once 'Shared/Transfer/StringTruncatorTransfer.php';

use Shared\Transfer\StringTruncatorTransfer;

interface StringTruncatorFacadeInterface
{
    /**
     * Specification:
     * - Truncates a given string to a specified length without breaking the sentence.
     *
     * @api
     *
     * @param \Shared\Transfer\StringTruncatorTransfer $stringTruncatorTransfer
     *
     * @return string
     */
    public function truncateString(StringTruncatorTransfer $stringTruncatorTransfer): string;
}
