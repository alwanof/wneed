<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    use Multitenantable;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function agent()
    {
        return $this->belongsTo(User::class, 'parent');
    }
}
