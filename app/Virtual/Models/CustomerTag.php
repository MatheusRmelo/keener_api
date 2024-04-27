<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="CustomerTag",
 *     description="CustomerTag model",
 *     @OA\Xml(
 *         name="CustomerTag"
 *     )
 * )
 */
class CustomerTag
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
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $customer_id;

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
    private $tag_id;
}
