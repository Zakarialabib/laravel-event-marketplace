<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidRequest extends Exception
{
    public static function amountNotSpecified(): self
    {
        return new self(__('The transaction amount has not been provided. Please provide a transaction amount.'));
    }

    public static function amountValueInvalid(): self
    {
        return new self(__('The entered transaction amount is invalid. Please provide a numeric value for the amount without a currency symbol. Use "." or "," as the decimal separator.'));
    }

    public static function currencyNotSpecified(): self
    {
        return new self(__('The currency code has not been provided. Please provide an ISO code for the transaction currency.'));
    }

    public static function currencyValueInvalid(): self
    {
        return new self(__('The provided currency code is invalid. Please provide a numeric ISO 4217 code for the currency. ISO code for MAD is 504.'));
    }

    public static function attributeNotSpecified(string $attribute): self
    {
        return new self(__('The :attribute has not been provided. Please provide it.', ['attribute' => $attribute]));
    }

    public static function attributeInvalidString(string $attribute): self
    {
        return new self(__('The provided value for :attribute is not valid. Please provide an :attribute that does not contain any spaces or an empty string.', ['attribute' => $attribute]));
    }

    public static function emailValueInvalid(): self
    {
        return new self(__('The provided customer email address is not a valid email address.'));
    }
}
