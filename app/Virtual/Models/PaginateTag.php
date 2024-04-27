<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="PaginateTag",
 *     description="PaginateTag model",
 *     @OA\Xml(
 *         name="PaginateTag"
 *     )
 * )
 */
class PaginateTag extends PaginateResponse
{
    /**
     * @OA\Property(
     *      title="Itens listados",
     *      description="Itens listados"
     * )
     *
     * @var Tag[]
     */
    public $data;
}
