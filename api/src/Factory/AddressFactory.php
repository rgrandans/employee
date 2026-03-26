<?php
declare(strict_types=1);

namespace App\Factory;

use App\Dto\Employee\Request\AddressDto;
use App\Entity\Embedable\Address;

final readonly class AddressFactory
{
    public static function create(AddressDto $address): Address
    {
        return new Address(
            $address->countryCode,
            $address->city,
            $address->street,
            $address->streetNumber,
            $address->postalCode
        );
    }
}
