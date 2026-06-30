<?php

namespace JeffersonGoncalves\Commerce\Core\Support;

use InvalidArgumentException;
use JsonSerializable;

/**
 * Immutable monetary value stored as an integer amount in a currency's minor
 * units (e.g. cents) plus an ISO 4217 currency code.
 */
final class Money implements JsonSerializable
{
    public function __construct(
        public readonly int $amount,
        public readonly string $currency,
    ) {}

    public static function of(int $amount, string $currency): self
    {
        return new self($amount, strtolower($currency));
    }

    /**
     * @param  array{amount?: int|string, currency?: string}  $data
     */
    public static function fromArray(array $data): self
    {
        if (! isset($data['amount'], $data['currency'])) {
            throw new InvalidArgumentException('Money requires both "amount" and "currency".');
        }

        return new self((int) $data['amount'], strtolower((string) $data['currency']));
    }

    public function add(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->amount + $other->amount, $this->currency);
    }

    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);

        return new self($this->amount - $other->amount, $this->currency);
    }

    public function isZero(): bool
    {
        return $this->amount === 0;
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException("Currency mismatch: {$this->currency} vs {$other->currency}.");
        }
    }

    /**
     * @return array{amount: int, currency: string}
     */
    public function toArray(): array
    {
        return ['amount' => $this->amount, 'currency' => $this->currency];
    }

    /**
     * @return array{amount: int, currency: string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
