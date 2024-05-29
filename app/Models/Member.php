<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book.
 *
 * @author  Nurdin <nurdin030101@gmail.com>
 *
 * @OA\Schema(
 *     description="Member model",
 *     title="Member model",
 *     required={"code", "name", "is_penalty"},
 *     @OA\Xml(
 *         name="Member"
 *     )
 * )
 */
class Member extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'is_penalty'];

    /**
     * @OA\Property(
     *     format="int64",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var int
     */

    /**
     * @OA\Property(
     *     format="string",
     *     description="Code",
     *     title="Code",
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     format="string",
     *     description="Name",
     *     title="Name",
     * )
     *
     * @var string
     */


    /**
     * @OA\Property(
     *     format="bool",
     *     description="Is Penalty",
     *     title="Is Penalty",
     * )
     *
     * @var bool
     */
}
