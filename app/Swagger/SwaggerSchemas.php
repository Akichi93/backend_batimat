<?php

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     required={"name", "description", "price", "stock"},
 *     properties={
 *         @OA\Property(property="id", type="integer", format="int64"),
 *         @OA\Property(property="uuid", type="string"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="description", type="string"),
 *         @OA\Property(property="price", type="number", format="float"),
 *         @OA\Property(property="stock", type="integer", format="int32"),
 *         @OA\Property(property="created_at", type="string", format="date-time"),
 *         @OA\Property(property="updated_at", type="string", format="date-time")
 *     }
 * )
 */

/**
 * @OA\Schema(
 *     schema="ProductStoreRequest",
 *     type="object",
 *     title="Store Product Request",
 *     required={"name", "description", "price", "stock"},
 *     properties={
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="description", type="string"),
 *         @OA\Property(property="price", type="number", format="float"),
 *         @OA\Property(property="stock", type="integer", format="int32")
 *     }
 * )
 */
