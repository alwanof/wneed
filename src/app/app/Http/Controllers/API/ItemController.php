<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Item as ResourcesItem;
use App\Item;
use App\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug = ($request->input('user')) ? $request->input('user') : null;
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $items = Item::where('user_id', $user->id);

        $limit = ($request->input('limit') && $request->input('limit') <= 100) ? $request->input('limit') : 25;
        $item = ResourcesItem::collection($items->paginate($limit));
        return $item->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $item = new ResourcesItem($item);
        return $item->response()->setStatusCode(200);
    }

    public function search(Request $filters)
    {
        $limit = ($filters->input('limit') && $filters->input('limit') <= 100) ? $filters->input('limit') : 25;
        $slug = ($filters->input('user')) ? $filters->input('user') : null;
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $item = (new Item)->newQuery();
        $item->where('user_id', $user->id)
            ->where('available', 1);

        if ($filters->has('maintitle')) {
            $item->where('title_a', 'LIKE', "%{$filters->input('maintitle')}%");
        }


        if ($filters->has('atltitle')) {
            $item->where('title_b', 'LIKE', "%{$filters->input('alttitle')}%");
        }
        if ($filters->has('maindesc')) {
            $item->where('desc_a', 'LIKE', "%{$filters->input('maindesc')}%");
        }

        if ($filters->has('altdesc')) {
            $item->where('desc_b', 'LIKE', "%{$filters->input('altdesc')}%");
        }


        $item =  ResourcesItem::collection($item->paginate($limit));
        return $item->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }
}
