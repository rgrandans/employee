<?php
declare(strict_types=1);

namespace App\Dto\Employee\Response;

final readonly class EmployeeListDtoFactory
{
    public static function createFromArray(array $employees): EmployeeListDto
    {
        $list = array_map(fn($employee) => new EmployeeListItemDto(
            $employee->getId(),
            $employee->getName(),
            $employee->getSurname(),
            $employee->getEmail(),
            $employee->getPhone()
        ), $employees);

        return new EmployeeListDto($list);
    }
}
