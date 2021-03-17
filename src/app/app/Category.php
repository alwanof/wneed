<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Multitenantable;

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
