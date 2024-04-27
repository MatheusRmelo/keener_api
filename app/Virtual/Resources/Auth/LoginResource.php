<?php

namespace App\Virtual\Resources\Auth;

use App\Virtual\Resources\BaseResource;

/**
 * @OA\Schema(
 *     title="LoginResource",
 *     description="Base resource",
 *     @OA\Xml(
 *         name="LoginResource"
 *     )
 * )
 */
class LoginResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="resultado",
     *     example="1|XOIW3wzwgQz0EWlKy90NKrR2MVWWZfQH1lV8gIpS82b177e7"
     * )
     *
     * @var string
     */
    private $result;
}
