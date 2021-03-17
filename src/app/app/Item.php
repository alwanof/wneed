<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Multitenantable;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
