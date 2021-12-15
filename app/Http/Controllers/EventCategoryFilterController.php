<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\MediaFile;

class EventCategoryFilterController extends Controller
{
    public function filter($alias)
    {
        $categories = EventCategory::all();
        $id = EventCategory::where('name_ro', $alias)
            ->orWhere('name_ru', $alias)
            ->first()['id'];
        if (is_null(EventCategory::where('id', $id)->first()['parent_id'])) {
            $childId = EventCategory::where('parent_id', $id)->get();

            if (count($childId)) {
                foreach ($childId as $temp) {
                    $searchResultParent [] = Event::where('category_id', $temp['id'])->first();

                }


            } else {
                $searchResultParent = null;
            }

            $searchResult = Event::where('category_id', $id)->get();

            foreach ($searchResult as $event) {
                $event->mediaFiles
                    ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
                    ->where('model_id', $event->id)
                    ->first();
            }

            return view('filter.event-filter-result')->with(compact('searchResult', 'categories', 'searchResultParent'));

        } else {

            $searchResultParent = null;
            $searchResult = Event::where('category_id', $id)->get();
            foreach ($searchResult as $event) {
                $event->mediaFiles
                    ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
                    ->where('model_id', $event->id)
                    ->first();

            }
            return view('filter.event-filter-result')->with(compact('searchResult', 'categories', 'searchResultParent'));
        }
    }
}
