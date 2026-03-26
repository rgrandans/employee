<?php
declare(strict_types=1);

namespace App\Factory;

use App\Dto\Employee\Request\CreateEmployeeRequest;
use App\Entity\Employee;

final readonly class EmployeeFactory
{
    public static function create(CreateEmployeeRequest $request): Employee
    {
        return new Employee(
            $request->name,
            $request->surname,
            $request->personalIdentityNumber,
            $request->gender,
            $request->phone,
            $request->email,
            AddressFactory::create($request->address)
        );
    }
}
