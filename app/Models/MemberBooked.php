<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberBooked extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'book_id', 'booked_date', 'return_date', 'book_total'];
}
