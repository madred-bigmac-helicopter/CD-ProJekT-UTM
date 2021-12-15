<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class LessonController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($alias)
    {
        return view('admin.lessons.create')->with(compact('alias'));
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
            'title-ro' => 'required',
            'title-ru' => 'required',
            'start-time.*' => 'required',
            'end-time.*' => 'required',

        ]);
        $startTime = $request['start-time'];
        $endTime = $request['end-time'];
        $day = $request['day'];


        Lesson::create([
            'title_ro' => $request['title-ro'],
            'title_ru' => $request['title-ru'],
            'place_id' => (int)$request['place-id'],
        ]);
        $id = Lesson::where('title_ro', $request['title-ro'])->first()['id'];
        if (!$request->has('day') == 0) {

            for ($i = 0; $i < count($request['day']); $i++) {
                LessonSchedule::create([
                    'lesson_id' => $id,
                    'day' => $day[$i],
                    'start_time' => $startTime[$i],
                    'end_time' => $endTime[$i],
                ]);
            }
        }

        return redirect('/admin/lessons/' . $request['place-id']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $lessons = Lesson::where('place_id', $id)
            ->get();

        return view('admin.lessons.index')->with(compact('lessons'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $lessons = Lesson::findOrFail($id);
        $lessonHours = LessonSchedule::where('lesson_id', $lessons['id'])->get();

        return view('admin.lessons.edit')->with(compact('lessons', 'lessonHours'));
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
            'start-time.*' => 'required',
            'end-time.*' => 'required',
        ]);
        $day = $request['day'];
        $startTime = $request['start-time'];
        $endTime = $request['end-time'];

        Lesson::where('id', $id)
            ->update([
                'title_ro' => $request['title-ro'],
                'title_ru' => $request['title-ru'],
            ]);
        LessonSchedule::where('lesson_id', $id)
            ->delete();
        if (!$request->has('day') == 0) {
            for ($i = 0; $i < count($day); $i++) {
                LessonSchedule::create([
                    'lesson_id' => $id,
                    'day' => $day[$i],
                    'start_time' => $startTime[$i],
                    'end_time' => $endTime[$i],
                ]);
            }
        }
        $placeId = Lesson::where('id', $id)
            ->first()['place_id'];

        return redirect('/admin/lessons/' . $placeId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $placeId = Lesson::first()['place_id'];
        LessonSchedule::where('lesson_id', $id)
            ->delete();
        Lesson::where('id', $id)
            ->delete();
        return redirect('/admin/lessons/' . $placeId);
    }

    public function showTime($id)
    {
        $lessonSchedule = LessonSchedule::where('lesson_id', $id)
            ->get();
        $days = null;
        $lessonSchedule = $lessonSchedule->sortBy('day');
        foreach ($lessonSchedule as $temp) {
            $days [] = $temp->day;
        }
        return view('include.lesson-schedule')->with(compact('lessonSchedule', 'days'));

    }
}
