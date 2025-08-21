<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case PIX = 'P';
    case CREDIT_CARD = 'C';
    case DEBIT_CARD = 'D';
    public static function getFeeByPaymentMethod(): array
    {
        return [
            self::PIX->value => 1.00,
            self::CREDIT_CARD->value => 1.05,
            self::DEBIT_CARD->value => 1.03,
        ];
    }

    public static function getFeeByValue(string $value): ?float
    {
        $fees = self::getFeeByPaymentMethod();
        return $fees[$value] ?? null;
    }

    public static function toArray(): array
    {
        return [
            self::DEBIT_CARD->value,
            self::CREDIT_CARD->value,
            self::PIX->value,
        ];
    }
}
