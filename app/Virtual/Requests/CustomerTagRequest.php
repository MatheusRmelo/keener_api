<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="CustomerTagRequest",
 *      description="CustomerTagRequest",
 *      type="object",
 *      required={"customer_id", "tags"}
 * )
 */

class CustomerTagRequest
{
    /**
     * @OA\Property(
     *     title="ID do cliente",
     *     description="ID do cliente",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $customer_id;

    /**
     * @OA\Property(
     *     title="Tags (IDS)",
     *     description="Array com os IDs das tags",
     *     type="array",
     *     example={1},
     *     @OA\Items(type="integer", format="id"),
     * )
     */
    public $tags;
}
