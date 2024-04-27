<?php

namespace App\Virtual\Requests\Auth;

/**
 * @OA\Schema(
 *      title="RegisterRequest",
 *      description="RegisterRequest",
 *      type="object",
 *      required={"name","email","password"}
 * )
 */

class RegisterRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Nome do usuário",
     *      example="Matheus Melo"
     * )
     *
     * @var string
     */
    public $name;

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
