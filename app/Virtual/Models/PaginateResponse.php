<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="PaginateResponse",
 *     description="PaginateResponse model",
 *     @OA\Xml(
 *         name="PaginateResponse"
 *     )
 * )
 */
class PaginateResponse
{

    /**
     * @OA\Property(
     *     title="Página atual",
     *     description="Página atual",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $current_page;

    /**
     * @OA\Property(
     *     title="Total de itens",
     *     description="Total de itens",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $total;

    /**
     * @OA\Property(
     *     title="Itens por página",
     *     description="Itens por página",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $per_page;

    /**
     * @OA\Property(
     *      title="Primeira página URL",
     *      example="http://127.0.0.1:8000/api/customers?page=1"
     * )
     *
     * @var string
     */
    public $first_page_url;

    /**
     * @OA\Property(
     *      title="Última página URL",
     *      example="http://127.0.0.1:8000/api/customers?page=1"
     * )
     *
     * @var string
     */
    public $last_page_url;

    /**
     * @OA\Property(
     *      title="Próxima página URL",
     *      example="http://127.0.0.1:8000/api/customers?page=2"
     * )
     *
     * @var string
     */
    public $next_page_url;

    /**
     * @OA\Property(
     *      title="Página anterior URL",
     *      example="http://127.0.0.1:8000/api/customers?page=1"
     * )
     *
     * @var string
     */
    public $prev_page_url;
}
