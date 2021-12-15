<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Place;

class WellcomeController extends Controller
{
    public function show()
    {

        $places = Place::where('status', 0)
            ->paginate(4);
        $events = Event::paginate(4);
        return view('welcome')->with(compact('places', 'events'));
    }
}
