<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use Multitenantable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
