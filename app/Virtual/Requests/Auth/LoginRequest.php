<?php

namespace App\Virtual\Requests\Auth;

/**
 * @OA\Schema(
 *      title="LoginRequest",
 *      description="LoginRequest",
 *      type="object",
 *      required={"email","password"}
 * )
 */

class LoginRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="E-mail do usuário",
     *      example="matheusmelo@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Senha do usuário",
     *      example="123456"
     * )
     *
     * @var string
     */
    public $password;
}
