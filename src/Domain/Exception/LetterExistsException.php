<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class LetterExistsException extends \UnexpectedValueException
{
    private string $letter;

    public function __construct($message, $code, $previous)
    {
        parent::__construct($message, $code, $previous);
    }

    public function setLetter(string $letter): LetterExistsException
    {
        $this->letter = $letter;
        return $this;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }
}
