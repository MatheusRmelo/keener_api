<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Tag",
 *     description="Tag model",
 *     @OA\Xml(
 *         name="Tag"
 *     )
 * )
 */
class Tag
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Nome da tag",
     *      example="Suporte"
     * )
     *
     * @var string
     */
    public $name;
}
