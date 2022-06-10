<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function hint($id)
    {
        $task = Task::find($id);
        $user = User::find(Auth::user()->id);
        if (($user->points - $task->hint_cost) > 0) {
//            dd(Auth::user()->id,($user->points - $task->hint_cost));

            User::where('id',Auth::user()->id)->update([
                'points' => ($user->points - $task->hint_cost)
            ]);
            return $task->hint;
        } else {
            return '<p style="color: red">You have not enough points for use hint </p>';
        }

    }

    public function group(Request $request)
    {
        $task = null;
        if ($request['category'] == "all") {
            $task = Task::all();
        } else {
            $tasks = [];
            foreach ($request['category'] as $item) {
                $tasks [] = Task::where('category', $item)->get();
            }
            foreach ($tasks as $item) {
                if (count($item) > 0)
                    foreach ($item as $aux) {
                        $task [] = $aux;
                    }
            }
        }

        $user = User::find(Auth::user()->id);


        return view('practice.cards-table')->with(compact('task', 'user'))->render();
    }

    public function index()
    {
        return view('practice.index');
    }

    public function show()
    {
        return view("tasks.index");
    }

    public function modal($id)
    {
        return Task::find($id);
    }

    public function submit($flag, $id)
    {
        $task = Task::find($id);

        if ($task->flag == $flag) {
            $user = User::find(Auth::user()->id);

            if (!$user->tasks()->where('id', $task->id)->exists()) {
                $user->tasks()->attach($id);
                $points = $user->points + $task->points;
                User::where('id', Auth::user()->id)->update([
                    'points' => $points,
                ]);
            }

            return "success";
        } else {
            return "fail";
        }
    }

    public function downloadFiles($file)
    {
        $result = File::exists(storage_path('files/') . $file);
        if ($result) {
            return Storage::disk('files')->download($file);
        }
        return view("errors.404");
    }
}
