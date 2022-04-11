<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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
            };
            foreach ($tasks as $item){
                if (count($item)>0)
                foreach ($item as $aux){
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
}
