<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

final readonly class AddressDto
{
    public function __construct(
        public string $countryCode,
        public string $city,
        public string $street,
        public string $streetNumber,
        public string $postalCode
    ){}
}
