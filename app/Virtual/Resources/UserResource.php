<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User resource",
 *     @OA\Xml(
 *         name="UserResource"
 *     )
 * )
 */
class UserResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\User
     */
    private $result;
}
