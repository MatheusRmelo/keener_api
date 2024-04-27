<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="TagSaveRequest",
 *      description="TagSaveRequest",
 *      type="object",
 *      required={"name"}
 * )
 */

class TagSaveRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Nome da tag",
     *      example="Suporte"
     * )
     *
     * @var string
     */
    public $name;
}
