<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Order;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function go()
    {
        Order::where([
            'name' => 'Murat test',

        ])->delete();
        Order::where([
            'name' => 'Table 1',
            'user_id' => 12
        ])->delete();

        $driver = Driver::find(16);
        $driver->status = 2;
        $driver->save();
    }
}
