<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="LocationResource",
 *     description="Location resource",
 *     @OA\Xml(
 *         name="LocationResource"
 *     )
 * )
 */
class LocationResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Location
     */
    private $result;
}
