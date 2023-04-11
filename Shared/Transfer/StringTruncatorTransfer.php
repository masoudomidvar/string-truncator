<?php

namespace Shared\Transfer;

class StringTruncatorTransfer
{
    /**
     * @var string
     */
    protected string $string;

    /**
     * @var int
     */
    protected int $limit;

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @return void
     */
    public function setString($value): void
    {
        $this->string = $value;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return void
     */
    public function setLimit($value): void
    {
        $this->limit = $value;
    }
}