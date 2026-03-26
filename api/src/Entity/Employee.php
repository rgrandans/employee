<?php
declare(strict_types=1);

namespace App\Entity;

use App\Entity\Embedable\Address;
use App\Enum\Gender;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $surname;

    #[ORM\Column(length: 12)]
    private string $personalIdentityNumber;

    #[ORM\Column(length: 10)]
    private Gender $gender;

    #[ORM\Column(length: 20)]
    private string $phone;

    #[ORM\Column(length: 100)]
    private string $email;

    #[ORM\Embedded(class: Address::class)]
    private Address $address;

    public function __construct(
        string $name,
        string $surname,
        string $personalIdentityNumber,
        Gender $gender,
        string $phone,
        string $email,
        Address $address
    ){
        $this->name = $name;
        $this->surname = $surname;
        $this->personalIdentityNumber = $personalIdentityNumber;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Employee
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Employee
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): Employee
    {
        $this->surname = $surname;
        return $this;
    }

    public function getPersonalIdentityNumber(): string
    {
        return $this->personalIdentityNumber;
    }

    public function setPersonalIdentityNumber(string $personalIdentityNumber): Employee
    {
        $this->personalIdentityNumber = $personalIdentityNumber;
        return $this;
    }

    public function getGender(): Gender
    {
        return $this->gender;
    }

    public function setGender(Gender $gender): Employee
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Employee
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Employee
    {
        $this->email = $email;
        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): Employee
    {
        $this->address = $address;
        return $this;
    }
}
