<?php

namespace App\Http\Controllers\API;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Order;
use App\Parse\Stream;
use App\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function track($hash, $lat, $lng)
    {
        $driver = Driver::where('hash', $hash)->firstOrFail();
        $rest = User::find($driver->user_id);
        $olat = $rest->settings['coordinate_lat'];
        $olng = $rest->settings['coordinate_lng'];

        //$distance = cooDistance($olat, $olng, $lat, $lng);
        $distance = 1;

        $driver->lat = $lat;
        $driver->lng = $lng;
        $driver->distanc = $distance;
        $driver->save();

        $response1 = Stream::create([
            'pid' => $driver->id,
            'model' => 'Driver',
            'action' => 'U',
            'meta' => ['hash' => $driver->hash, 'rest' => $driver->user_id, 'agent' => $driver->parent]
        ]);

        return [
            'location' => $driver->lat . ' <> ' . $driver->lng,
            'distance' => $distance
        ];
    }

    public function checkActive($hash)
    {
        $driver = Driver::where('hash', $hash)->firstOrFail();

        return response($driver->status, 200);
    }

    public function getDriver($hash)
    {
        $driver = Driver::where('hash', $hash)->firstOrFail();
        $rest = User::find($driver->user_id);
        return response(['driver' => $driver, 'rest' => $rest], 200);
    }

    public function toggle($hash)
    {
        $driver = Driver::where('hash', $hash)->firstOrFail();
        $order = Order::where('driver_id', $driver->id)->whereIn('status', [1, 12])->count();
        if ($order == 0) {

            if ($driver->status == 0) {
                $driver->status = 2;
            } elseif ($driver->status == 2) {
                $driver->status = 0;
            }

            $driver->save();

            $response1 = Stream::create([
                'pid' => $driver->id,
                'model' => 'Driver',
                'action' => 'U',
                'meta' => ['hash' => $driver->hash, 'rest' => $driver->user_id, 'agent' => $driver->parent]
            ]);
        }

        return response($driver->status, 200);
    }

    public function reset($hash)
    {
        $driver = Driver::where('hash', $hash)->firstOrFail();
        $driver->status == 0;
        $driver->save();

        $response1 = Stream::create([
            'pid' => $driver->id,
            'model' => 'Driver',
            'action' => 'U',
            'meta' => ['hash' => $driver->hash, 'rest' => $driver->user_id, 'agent' => $driver->parent]
        ]);

        return response($driver->status, 200);
    }

    public function userDrivers($user_id)
    {
        $rest = User::findOrFail($user_id);
        if ($rest->level == 2) {
            return Driver::where('user_id', $rest->id)->where('status', 2)->get();
        }

        return [];
    }

    public function driverFetch($driver_id)
    {
        $driver = Driver::findOrFail($driver_id);
        if (is_object($driver)) {
            return $driver;
        }
        return false;
    }
}
