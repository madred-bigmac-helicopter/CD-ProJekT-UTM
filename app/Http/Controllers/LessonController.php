<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonSchedule;
use App\Models\Place;
use Illuminate\Support\Str;


class LessonController extends Controller
{
    public function index($alias)
    {

        $alias = Str::of($alias)->replace('-', ' ');
        $placeId = Place::where('name_ro', $alias)
            ->orWhere('name_ru', $alias)
            ->first();

        $lessons = Lesson::where('place_id', $placeId->id)
            ->get();

        foreach ($lessons as $lesson) {
            $lessonSchedule [] = LessonSchedule::where('lesson_id', $lesson->id)->get();
        }
        foreach ($lessonSchedule as $aux) {
            $days [] =
                $this->getDays($aux);
        }

        return view('lessons.show')->with(compact('lessonSchedule', 'lessons', 'days'));
    }

    public function getDays($temp)
    {

        $arr = [];
        foreach ($temp as $aux) {
            $arr [] = $aux->day;

        }

        return $arr;
    }

}
