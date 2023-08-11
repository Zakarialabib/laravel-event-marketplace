<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidConfiguration extends Exception
{
    public static function storeKeyNotSpecified(): static
    {
        return new static(__('The store key (storeKey) has not been provided. You must provide a valid store key, as configured in your CMI platform back office.'));
    }

    public static function storeKeyInvalid(): static
    {
        return new static(__('The provided store key (storeKey) is not valid. Please provide a store key that does not contain any spaces or an empty string.'));
    }

    public static function clientIdNotSpecified(): static
    {
        return new static(__('The merchant ID (clientId) has not been provided. You must provide a valid merchant ID, as assigned by CMI.'));
    }

    public static function clientIdInvalid(): static
    {
        return new static(__('The provided merchant ID (clientId) is not valid. Please provide a merchant ID that does not contain any spaces or an empty string.'));
    }

    public static function attributeNotSpecified(string $attribute): static
    {
        return new static(__('The :attribute has not been provided. Please provide it.', ['attribute' => $attribute]));
    }

    public static function attributeInvalidString(string $attribute): static
    {
        return new static(__('The provided value for :attribute is not valid. Please provide an :attribute that does not contain any spaces or an empty string.', ['attribute' => $attribute]));
    }

    public static function attributeInvalidUrl(string $attribute): static
    {
        return new static(__('The provided URL for :attribute is not valid. Please provide a valid link.', ['attribute' => $attribute]));
    }

    public static function langValueInvalid(): static
    {
        return new static(__('The default language value is not valid. Possible values are: ar, fr, en.'));
    }

    public static function sessionimeoutValueInvalid(): static
    {
        return new static(__('The session timeout (sessionTimeout) value is not valid. Please provide a valid number. The minimum allowed value is 30 seconds and the maximum is 2700 seconds.'));
    }
}
