<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;

    use Notifiable;

    use SoftDeletes;

    protected $table = 'admins';
    
    const ROLE_ADMIN = 1;
    const ROLE_EDITER = 2;
    const ROLE_SHIPPER = 3;
    
    protected $guarded = [];

    protected $fillable = [

    ];
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
