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
 *     ),
 *     @OA\Property(
 *         description="ID Buku",
 *         title="ID Buku",
 *         type="int",
 *         property="id",
 *     ),
 *     @OA\Property(
 *         description="Kode Buku",
 *         title="Kode Buku",
 *         type="string",
 *         property="code",
 *     ),
 *     @OA\Property(
 *         description="Judul Buku",
 *         title="Judul Buku",
 *         type="string",
 *         property="title",
 *     ),
 *     @OA\Property(
 *         description="Pembuat buku",
 *         title="Pembuat Buku",
 *         type="string",
 *         property="author",
 *     ),
 *     @OA\Property(
 *         description="Stok Buku tersisa",
 *         title="Stok Buku",
 *         type="int",
 *         property="stock",
 *     ),  
 * )
 */
class Book extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'title', 'author', 'stock'];
}
