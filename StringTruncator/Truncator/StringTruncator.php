<?php

namespace StringTruncator\Truncator;

require_once 'Shared/Transfer/StringTruncatorTransfer.php';
require_once 'StringTruncator/StringTruncatorConfig.php';
require_once 'StringTruncatorInterface.php';

use Shared\Transfer\StringTruncatorTransfer;
use StringTruncator\StringTruncatorConfig;
use StringTruncator\Truncator\StringTruncatorInterface;

class StringTruncator implements StringTruncatorInterface
{
    /**
     * @param \Shared\Transfer\StringTruncatorTransfer $stringTruncatorTransfer
     *
     * @return string
     */
    public function truncateString(StringTruncatorTransfer $stringTruncatorTransfer): string
    {
        if (strlen($stringTruncatorTransfer->getString()) <= $stringTruncatorTransfer->getLimit()) {
            return $stringTruncatorTransfer->getString();
        }

        if ($stringTruncatorTransfer->getLimit() <= 0) {
            return '';
        }

        $string = substr(
            $stringTruncatorTransfer->getString(),
            0,
            $stringTruncatorTransfer->getLimit()
        );

        if (
            in_array(
                substr($string, -1),
                StringTruncatorConfig::getSentenceIdentifiers()
            )
        ) {
            return $string;
        }

        $stringIdentifierPosition = $this->getStringIdentifierPosition(
            $string,
            StringTruncatorConfig::getSentenceIdentifiers()
        );

        if ($stringIdentifierPosition === null) {
            return substr($string, 0, $stringTruncatorTransfer->getLimit());
        }

        return substr($string, 0, $stringIdentifierPosition + 1);
    }

    /**
     * @param string $string
     * @param array $sentenceIdentifiers
     *
     * @return int|null
     */
    protected function getStringIdentifierPosition(string $string, array $sentenceIdentifiers): ?int
    {
        foreach($sentenceIdentifiers as $identifier) {
            if ($sentenceIdentifierPosition = strrpos($string, $identifier.' ')) {
                $sentenceIdentifierPositionArray[$identifier] = $sentenceIdentifierPosition;
            }
        }

        if (!empty($sentenceIdentifierPositionArray)) {
            return max($sentenceIdentifierPositionArray);
        }

        return null;
    }
}
