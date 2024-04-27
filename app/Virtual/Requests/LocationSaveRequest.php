<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="LocationSaveRequest",
 *      description="LocationSaveRequest",
 *      type="object",
 *      required={"latitude", "longitude"}
 * )
 */

class LocationSaveRequest
{
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
