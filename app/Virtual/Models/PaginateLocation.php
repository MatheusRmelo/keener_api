<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="PaginateLocation",
 *     description="PaginateLocation model",
 *     @OA\Xml(
 *         name="PaginateLocation"
 *     )
 * )
 */
class PaginateLocation extends PaginateResponse
{
    /**
     * @OA\Property(
     *      title="Itens listados",
     *      description="Itens listados"
     * )
     *
     * @var Location[]
     */
    public $data;
}
