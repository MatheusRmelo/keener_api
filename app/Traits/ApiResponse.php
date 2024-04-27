<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

trait ApiResponse
{
    protected function success($result = null, string $description = 'Sucesso'): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'result' => $result,
            'description' => $description
        ], 200);
    }

    protected function create($result = null, string $description = 'Criado'): JsonResponse
    {
        return response()->json([
            'description' => $description,
            'ok' => true,
            'result' => $result
        ], 201);
    }

    protected function noContent(): Response
    {
        return response()->noContent();
    }

    protected function badRequest(MessageBag|null $errors, string $description = 'Requisição inválida')
    {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'description' => $description,
            'technicalDescription' => 'Alguns campos da requisição não são válidos'
        ], 400);
    }

    protected function unathorized(
        string $description,
        string $technicalDescription = 'Você não tem essa permissão',
        MessageBag|null $errors = null
    ) {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'description' => $description,
            'technicalDescription' => $technicalDescription
        ], 401);
    }

    protected function forbidden(
        string $description,
        string $technicalDescription = 'Proibido',
        MessageBag|null $errors = null
    ) {
        return response()->json([
            'ok' => false,
            'result' => null,
            'errors' => $errors,
            'description' => $description,
            'technicalDescription' => $technicalDescription
        ], 403);
    }

    protected function notFound($result = null, string $message = 'Não encontrado'): JsonResponse
    {
        return response()->json([
            'ok' => false,
            'result' => $result,
            'description' => $message,
        ], 404);
    }

    protected function serverError($result = null, string $description = 'Não encontrado'): JsonResponse
    {
        return response()->json([
            'ok' => false,
            'result' => $result,
            'description' => $description,
            'technicalDescription' => $description
        ], 500);
    }
}
