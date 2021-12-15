<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;
use App\Models\Place;
use App\Models\PlaceCategory;
use Illuminate\Support\Str;


class PlaceCategoryFilterController extends Controller
{
    public function filter($alias)
    {
        $alias= Str::of($alias)->replace('-',' ');
        $categories = PlaceCategory::all();
        $id = PlaceCategory::where('name_ro', $alias)
            ->orWhere('name_ru', $alias)
            ->first()['id'];
        if (is_null(PlaceCategory::where('id', $id)->first()['parent_id'])) {
            $childId = PlaceCategory::where('parent_id', $id)->get();
            if (!count($childId) == 0) {
                foreach ($childId as $temp) {
                    $searchResultParent [] = Place::where('category_id', $temp['id'])->first();
                }
            } else {
                $searchResultParent = null;
            }

            $searchResult = Place::where('category_id', $id)
                ->where('status',0)
                ->get();

            foreach ($searchResult as $place) {
                $place->mediaFiles
                    ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
                    ->where('model_id', $place->id)
                    ->first();
            }


            return view('filter.place-filter-result')->with(compact('searchResult', 'categories', 'searchResultParent'));

        } else {

            $searchResultParent = null;
            $searchResult = Place::where('category_id', $id)
                ->where('status',0)
                ->get();
            foreach ($searchResult as $place) {
                $place->mediaFiles
                    ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
                    ->where('model_id', $place->id)
                    ->first();

            }

            return view('filter.place-filter-result')->with(compact('searchResult', 'categories', 'searchResultParent','alias'));
        }
    }
}
