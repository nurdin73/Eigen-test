<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPenalty extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'booked_id', 'until'];
}
