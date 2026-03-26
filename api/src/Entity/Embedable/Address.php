<?php
declare(strict_types=1);

namespace App\Entity\Embedable;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Address
{
    #[ORM\Column(length: 2)]
    private string $countryCode;

    #[ORM\Column(length: 100)]
    private string $city;

    #[ORM\Column(length: 100)]
    private string $street;

    #[ORM\Column(length: 10)]
    private string $streetNumber;

    #[ORM\Column(length: 7)]
    private string $postalCode;

    public function __construct(
        string $countryCode,
        string $city,
        string $street,
        string $streetNumber,
        string $postalCode
    ){
        $this->countryCode = $countryCode;
        $this->city = $city;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->postalCode = $postalCode;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getStreetNumber(): string
    {
        return $this->streetNumber;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
}
