<?php
declare(strict_types=1);

namespace App\Service;

use App\Dto\Employee\Request\CreateEmployeeRequest;
use App\Dto\Employee\Request\UpdateEmployeeRequest;
use App\Dto\Employee\Response\EmployeeDto;
use App\Dto\Employee\Response\EmployeeDtoFactory;
use App\Dto\Employee\Response\EmployeeListDto;
use App\Dto\Employee\Response\EmployeeListDtoFactory;
use App\Factory\AddressFactory;
use App\Factory\EmployeeFactory;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class EmployeeService
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private EntityManagerInterface $entityManager,
    ){}

    public function getList(): EmployeeListDto
    {
        $employees = $this->employeeRepository->findAllEmployees();

        return EmployeeListDtoFactory::createFromArray($employees);
    }

    public function createEmployee(CreateEmployeeRequest $request): EmployeeDto
    {
        $employee = EmployeeFactory::create($request);

        $this->entityManager->persist($employee);
        $this->entityManager->flush();

        return EmployeeDtoFactory::createFromEmployee($employee);
    }

    public function updateEmployee(UpdateEmployeeRequest $request): EmployeeDto
    {
        $employee = $this->employeeRepository->getEmployee($request->id);
        if (!$employee) {
            throw new NotFoundHttpException('No employee found for id ' . $request->id);
        }

        $employee->setName($request->name);
        $employee->setSurname($request->surname);
        $employee->setPersonalIdentityNumber($request->personalIdentityNumber);
        $employee->setGender($request->gender);
        $employee->setPhone($request->phone);
        $employee->setEmail($request->email);
        $employee->setAddress(AddressFactory::create($request->address));

        $this->entityManager->persist($employee);
        $this->entityManager->flush();

        return EmployeeDtoFactory::createFromEmployee($employee);
    }

    public function getEmployee(int $id): EmployeeDto
    {
        $employee = $this->employeeRepository->getEmployee($id);
        if (!$employee) {
            throw new NotFoundHttpException('No employee found for id ' . $id);
        }

        return EmployeeDtoFactory::createFromEmployee($employee);
    }

    public function deleteEmployee(int $id): void
    {
        $employee = $this->employeeRepository->getEmployee($id);
        if (!$employee) {
            throw new NotFoundHttpException('No employee found for id ' . $id);
        }

        $this->entityManager->remove($employee);
        $this->entityManager->flush();
    }
}
