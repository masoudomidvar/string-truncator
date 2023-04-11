<?php

namespace StringTruncator;

require_once 'Shared/Transfer/StringTruncatorTransfer.php';
require_once 'StringTruncatorFacadeInterface.php';
require_once 'StringTruncatorFactory.php';

use Shared\Transfer\StringTruncatorTransfer;
use StringTruncator\StringTruncatorFacadeInterface;
use StringTruncator\StringTruncatorFactory;

class StringTruncatorFacade implements StringTruncatorFacadeInterface
{
    /**
     * @param \StringTruncator\StringTruncatorFactory $stringTruncatorFactory
     */
    public function __construct(
        protected StringTruncatorFactory $stringTruncatorFactory = new StringTruncatorFactory()
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Shared\Transfer\StringTruncatorTransfer $stringTruncatorTransfer
     *
     * @return string
     */
    public function truncateString(StringTruncatorTransfer $stringTruncatorTransfer): string
    {
        return $this->stringTruncatorFactory->createStringTruncator()->truncateString($stringTruncatorTransfer);
    }
}
