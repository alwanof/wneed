<?php

namespace App;

use App\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Multitenantable;
    // 0 new S D
    // 1 Driver Selected
    // 12 Order Approved
    // 13 Order reject from driver
    // 2 Order Deliveried
    // 3 canceled from new
    // 31 canceled from Driver Selected
    // 32 canceled Picked

    //Office: 1=> S D | 12 => Send Offer
    //Driver: 2 => Y/N option | 21 on the way
    //Customer: 3 => Y/N option
    //Done 9=> done | 91=> RO | 92=>RC | 93=>NoRO | 94=>NoRC 99=>CC

    // cd /home/whatsappneed.com/public_html
    //rm -rf storage

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function rest()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'parent');
    }
}
