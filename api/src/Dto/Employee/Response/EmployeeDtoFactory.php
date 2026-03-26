<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

use App\Entity\Employee;

final readonly class EmployeeDtoFactory
{
    public static function createFromEmployee(Employee $employee): EmployeeDto
    {
        return new EmployeeDto(
            $employee->getId(),
            $employee->getName(),
            $employee->getSurname(),
            $employee->getPersonalIdentityNumber(),
            $employee->getGender(),
            $employee->getPhone(),
            $employee->getEmail(),
            AddressDtoFactory::create($employee->getAddress())
        );
    }
}
