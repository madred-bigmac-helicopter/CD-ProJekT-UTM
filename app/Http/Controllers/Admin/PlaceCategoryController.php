<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlaceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = PlaceCategory::paginate(10);

        return view('admin.place-categories.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = PlaceCategory::all();
        return view('admin.place-categories.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([

        ]);

        if ($request['parent-id'] == 'null') {
            $parentId = null;
            PlaceCategory::create([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentId,
            ]);
        } else {
            $parentId = PlaceCategory::where('name_ro', $request['parent-id'])
                ->orWhere('name_ru', $request['parent-id'])
                ->pluck('id');
            PlaceCategory::create([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentId[0],
            ]);
        }

        return redirect('/admin/place-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $name = PlaceCategory::find($id);
        $categories = PlaceCategory::all();

        return view('admin.place-categories.edit')->with(compact('categories', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

        ]);

        if (!$request['parent-id'] == null) {
            $parentID = PlaceCategory::where('name_ro', $request['parent-id'])
                ->orWhere('name_ru', $request['parent-id'])
                ->first()['id'];
        } else {
            $parentID = null;
        }

        PlaceCategory::find($id)
            ->update([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentID,
            ]);
        return redirect('/admin/place-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        PlaceCategory::find($id)
            ->delete();
        return redirect('/admin/place-categories');
    }
}
