<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Place;
use App\Models\PlaceCategory;
use Illuminate\Support\Str;


class MapController extends Controller
{
    public function map($category)
    {
        $category =Str::of($category)->replace('-',' ');


            $categories = PlaceCategory::all();
            $coords = $this->places($category);


        if (count($coords) == 0) {
            $coords = null;

            return view('map')->with(compact('categories',  'coords'));
        } else {

            return view('map')->with(compact('categories',  'coords'));
        }
    }

    public function places($category)
    {

        $coords = [];
        if ($category == 'all') {
            $places = Place::all();
            foreach ($places as $temp) {

                $coords [] = array($temp['title_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id'],$temp['name_ro']);
            }
        } else {

            $id = PlaceCategory::where('name_ro', $category)
                ->orWhere('name_ru', $category)
                ->first()['id'];

            if (is_null(PlaceCategory::where('id', $id)->first()['parent_id'])) {
                $childId = PlaceCategory::where('parent_id', $id)->get();

                if (!count($childId) == 0) {
                    $searchResultParent = [];
                    foreach ($childId as $temp) {
                        if (!is_null(Place::where('category_id', $temp['id'])->first())) {
                            $searchResultParent [] = Place::where('category_id', $temp['id'])->first();
                        }
                    }

                } else {
                    $searchResultParent = null;
                }
                $searchResult = Place::where('category_id', $id)->get();
                foreach ($searchResult as $temp) {
                    $coords [] = array($temp['title_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id'],$temp['name_ro']);
                }
                if (!is_null($searchResultParent)) {
                    foreach ($searchResultParent as $temp) {
                        $coords [] = array($temp['title_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id'],$temp['name_ro']);
                    }
                }
            } else {
                $searchResult = Place::where('category_id', $id)->get();
                foreach ($searchResult as $temp) {
                    $coords [] = array($temp['title_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id'], $temp['name_ro']);
                }
            }
        }

        return $coords;
    }

//    public function events($category)
//    {
//        $coords = [];
//        if ($category == __('routes.all')) {
//            $events = Event::all();
//            foreach ($events as $temp) {
//                $places [] = Place::where('id', $temp['place_id'])->first();
//            }
//            foreach ($places as $temp) {
//                $coords [] = array($temp['name_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id']);
//            }
//
//        } else {
//            $id = EventCategory::where('name_ro', $category)
//                ->orWhere('name_ru', $category)
//                ->first()['id'];
//            if (is_null(EventCategory::where('id', $id)->first()['parent_id'])) {
//                $childId = EventCategory::where('parent_id', $id)->get();
//                if (!count($childId) == 0) {
//                    $searchResultParent = [];
//                    foreach ($childId as $temp) {
//                        if (!is_null(Event::where('category_id', $temp['id'])->first())) {
//                            $searchResultParent [] = Event::where('category_id', $temp['id'])->first();
//                        }
//                    }
//                    if (!is_null($searchResultParent)) {
//                        $places = [];
//                        foreach ($searchResultParent as $temp) {
//                            $places [] = Place::where('id', $temp['place_id'])->first();
//                        }
//                        foreach ($places as $temp) {
//                            $coords [] = array($temp['name_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id']);
//                        }
//                    }
//
//                } else {
//                    $searchResultParent = null;
//                }
//                $searchResult = Event::where('category_id', $id)->get();
//                $places = [];
//                foreach ($searchResult as $temp) {
//                    $places [] = Place::where('id', $temp['place_id'])->first();
//                }
//                foreach ($places as $temp) {
//                    $coords [] = array($temp['name_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id']);
//                }
//            } else {
//                $places = [];
//                $searchResult = Event::where('category_id', $id)->get();
//                foreach ($searchResult as $temp) {
//                    $places [] = Place::where('id', $temp['place_id'])->first();
//                }
//                foreach ($places as $temp) {
//                    $coords [] = array($temp['name_ro'], $temp['coords_long'], $temp['coords_lat'], $temp['id']);
//                }
//            }
//        }
//        return $coords;
//    }
}

