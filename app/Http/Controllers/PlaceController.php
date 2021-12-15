<?php

namespace App\Http\Controllers;


use App\Models\Lesson;
use App\Models\MediaFile;
use App\Models\Place;
use App\Models\PlaceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $places = Place::all();
        $categories = PlaceCategory::all();

        foreach ($places as $place) {
            $place->mediaFiles
                ->where('model_type', MediaFile::MODEL_TYPE_PLACE)
                ->where('model_id', $place->id)
                ->first();


        }


        return view('places.index')->with(compact('places', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($alias)
    {


        $place = Place::where('name_ro',$alias)
            ->orWhere('name_ru',$alias)
            ->first();

        $lessons = Lesson::where('place_id', $place->id)
            ->get();

//

//
//        foreach ($lessons as $lesson) {
//            if (LessonSchedule::where('lesson_id', $lesson->id)
//                    ->first() === null) {
//                $lessonHours [] = $lesson->id;
//            } else {
//                $lessonHours [] = LessonSchedule::where('lesson_id', $lesson->id)
//                    ->first();
//            }
//        }
//        foreach ($lessonHours as $time) {
//            if (is_int($time)) {
//                $remcollect = $time;
//            }
//        }
//        $i = 0;
//        foreach ($lessons as $lesson) {
//            if ($lesson->id == $remcollect) {
//                $lessons->forget($i);
//            }
//            $i++;
//        }

        return view('places.show')->with(compact('place','lessons'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
