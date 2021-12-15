<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = EventCategory::paginate(10);

        return view('admin.event-categories.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EventCategory::all();
        return view('admin.event-categories.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

        ]);

        if ($request['parent-id'] == 'null') {
            $parentId = null;
            EventCategory::create([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentId,
            ]);
        } else {
            $parentId = EventCategory::where('parent_id', $request['parent-id'])
                ->pluck('id');
            EventCategory::create([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentId[0],
            ]);
        }

        return redirect('/admin/event-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $name = EventCategory::find($id);
        $categories = EventCategory::all();
        return view('admin.event-categories.edit')->with(compact('categories', 'name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        $request->validate([
//
//        ]);
        if (!$request['parent-id'] == null) {
            $parentID = EventCategory::where('name', $request['parent-id'])
                ->first()['id'];
        } else {
            $parentID = null;
        }

        EventCategory::find($id)
            ->update([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'parent_id' => $parentID,
            ]);
        return redirect('/admin/event-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventCategory::find($id)
            ->delete();
        return redirect('/admin/event-categories');
    }
}
