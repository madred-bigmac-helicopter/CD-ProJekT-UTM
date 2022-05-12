<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
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

        return view('practice.cards-table')->with(compact('task'))->render();
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
