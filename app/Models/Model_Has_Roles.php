<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_Has_Roles extends Model
{
    use HasFactory;
    protected $table="model_has_roles";

    protected $guarded=[];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'model_id', 'id');
    // }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'role_id', 'id');
    // }
}
