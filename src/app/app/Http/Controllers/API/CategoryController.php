<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\Category as ResourcesCategory;
use App\Http\Resources\Item as ResourcesItem;
use App\User;
use Illuminate\Http\Request;


class CategoryController extends Controller
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

        $limit = ($request->input('limit') && $request->input('limit') <= 100) ? $request->input('limit') : 25;
        $categories = Category::where('user_id', $user->id);

        $category = ResourcesCategory::collection($categories->paginate($limit));
        return $category->response()->setStatusCode(200);
    }

    public function categoryItems(Request $request, $id)
    {
        $slug = ($request->input('user')) ? $request->input('user') : null;
        $user = User::where('slug', '=', $slug)->firstOrFail();
        $category = Category::findOrFail($id);
        if ($category->user_id != $user->id) {
            return abort(404);
        }
        $limit = ($request->input('limit') && $request->input('limit') <= 100) ? $request->input('limit') : 25;
        $item = ResourcesItem::collection($category->items()->paginate($limit));
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
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
    }
}
