<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="CustomerTagResource",
 *     description="CustomerTag resource",
 *     @OA\Xml(
 *         name="CustomerTagResource"
 *     )
 * )
 */
class CustomerTagResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Tag[]
     */
    private $result;
}
