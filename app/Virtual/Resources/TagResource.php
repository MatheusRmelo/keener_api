<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="TagResource",
 *     description="Tag resource",
 *     @OA\Xml(
 *         name="TagResource"
 *     )
 * )
 */
class TagResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Tag
     */
    private $result;
}
