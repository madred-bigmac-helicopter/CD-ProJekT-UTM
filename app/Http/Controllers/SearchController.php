<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Place;
use App\Models\PlaceCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function suggestion($alias)
    {
        $places = Place::whereRaw(
            "MATCH(full_text_data_ro) AGAINST(?)",
            array($alias)
        )->get();
        $aliasSplitCount = count(str_split($alias));
        if($aliasSplitCount>2){
            $places = $places->merge(Place::where('full_text_data_ro','LIKE','%'.$alias.'%')->get());
        }
        return view("include.suggestion")->with(compact('places'));
    }

    public function search(Request $request)
    {
         $search =  implode(",",explode('-',str_slug($request->search)));

        $places = Place::whereRaw(
            "MATCH(full_text_data_ro) AGAINST(?)",
            array($search)
        )->get();
        $aliasSplitCount = count(str_split($search));
        if($aliasSplitCount>2){
            $places = $places->merge(Place::where('full_text_data_ro','LIKE','%'.$search.'%')->get());
        }
        $searchWord = $request->search;
        return view("search")->with(compact("places", 'searchWord'));
    }

}

