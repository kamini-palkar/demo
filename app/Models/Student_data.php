<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_data extends Model
{
    use HasFactory;
    protected $table="student_data";
    protected $fillable = [
        'unique_id','firstname', 'lastname'
    ];
}
