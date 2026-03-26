<?php
declare(strict_types=1);

namespace App\Controller;

use App\Dto\Employee\Request\CreateEmployeeRequest;
use App\Dto\Employee\Request\UpdateEmployeeRequest;
use App\Service\EmployeeService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/employees')]
final readonly class EmployeeController
{
    public function __construct(
        private EmployeeService $employeeService
    ){}

    #[Route('', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $response = $this->employeeService->getList();

        return new JsonResponse($response);
    }

    #[Route('', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CreateEmployeeRequest $request
    ): JsonResponse
    {
        try {
            $employee = $this->employeeService->createEmployee($request);

            return new JsonResponse($employee, Response::HTTP_CREATED);
        } catch (HttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $response = $this->employeeService->getEmployee($id);

        return new JsonResponse($response);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(
        #[MapRequestPayload] UpdateEmployeeRequest $request
    ): JsonResponse
    {
        try {
            $employee = $this->employeeService->updateEmployee($request);

            return new JsonResponse($employee, Response::HTTP_CREATED);
        } catch (HttpException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->employeeService->deleteEmployee($id);

        return new JsonResponse(['message' => 'Employee deleted successfully'], Response::HTTP_OK);
    }
}
