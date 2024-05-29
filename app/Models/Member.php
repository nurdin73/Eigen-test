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
 *     ),
 *     @OA\Property(
 *         type="int",
 *         property="id",
 *         description="ID Member",
 *         title="ID Member"
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="code",
 *         description="Kode Member",
 *         title="Kode Member"
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="name",
 *         description="Nama Member",
 *         title="Nama Member"
 *     ),
 *     @OA\Property(
 *         type="bool",
 *         property="is_penalty",
 *         description="Penalti",
 *         title="Penalti"
 *     ),
 * )
 */
class Member extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'is_penalty'];
}
