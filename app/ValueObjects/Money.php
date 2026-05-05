<?php

namespace App\ValueObjects;

use Exception;

class Money
{
    private int $cents;

    public function __construct(int $cents)
    {
        $this->cents = $cents;
    }

    public static function fromCents(int $cents): self
    {
        return new self($cents);
    }

    public static function fromEuros(float $euros): self
    {
        return new self(round($euros * 100.0));
    }

    public function cents(): int
    {
        return $this->cents;
    }

    public function euros(): float
    {
        return $this->cents / 100.0;
    }

    /**
     * @throws Exception
     */
    public function subtract(self $other): self
    {
        if ($this->cents < $other->cents) {
            throw new Exception('Vous ne pouvez pas soustraire plus que la valeur actuelle');
        }
        return new self($this->cents - $other->cents);
    }

    public function add(self $other): self
    {
        return new self($this->cents + $other->cents);
    }

    public function format(): string
    {
        return number_format($this->euros(), 2, ',', ' ') . ' €';
    }
}
