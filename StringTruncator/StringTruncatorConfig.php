<?php

namespace StringTruncator;

enum StringTruncatorConfig: string
{
    case SentenceIdentifierDot = '.';
    case SentenceIdentifierQuestion = '?';
    case SentenceIdentifierExclamation = '!';

    public static function getSentenceIdentifiers(): array
    {
        return [
            self::SentenceIdentifierDot->value,
            self::SentenceIdentifierQuestion->value,
            self::SentenceIdentifierExclamation->value,
        ];
    }
}
