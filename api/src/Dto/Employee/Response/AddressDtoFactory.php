<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

use App\Entity\Embedable\Address;

final readonly class AddressDtoFactory
{
    public static function create(Address $address): AddressDto
    {
        return new AddressDto(
            $address->getCountryCode(),
            $address->getCity(),
            $address->getStreet(),
            $address->getStreetNumber(),
            $address->getPostalCode()
        );
    }
}
