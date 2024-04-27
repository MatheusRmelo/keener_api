<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Location",
 *     description="Location model",
 *     @OA\Xml(
 *         name="Location"
 *     )
 * )
 */
class Location
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
     *      title="Latitude",
     *      description="Latitude do local",
     *      example="-222"
     * )
     *
     * @var string
     */
    public $latitude;

    /**
     * @OA\Property(
     *      title="Longitude",
     *      description="Longitude do local",
     *      example="-44"
     * )
     *
     * @var string
     */
    public $longitude;
}
