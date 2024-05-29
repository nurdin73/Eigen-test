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
 *     description="Book model",
 *     title="Book model",
 *     required={"code", "title", "author", "stock"},
 *     @OA\Xml(
 *         name="Book"
 *     )
 * )
 */
class Book extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'title', 'author', 'stock'];

    /**
     * @OA\Property(
     *     type="int",
     *     property="id",
     *     description="ID",
     *     title="ID",
     * )
     *
     * @var int
     */

    /**
     * @OA\Property(
     *     type="string",
     *     property="code",
     *     title="Code",
     *     description="Code"
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     type="string",
     *     property="author",
     *     title="Author",
     *     description="Author"
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     type="string",
     *     property="title",
     *     title="title",
     *     description="title"
     * )
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     type="int",
     *     property="stock",
     *     title="Stock",
     *     description="Stock"
     * )
     *
     * @var int
     */
}
