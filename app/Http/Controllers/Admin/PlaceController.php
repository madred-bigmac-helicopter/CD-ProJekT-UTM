<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaFile;
use App\Models\Place;
use App\Models\PlaceCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\matches;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return Response
     */
    public function index()
    {
        $userId = Auth::user()->getAuthIdentifier();
        if (Auth::user()->roles->first()['name'] == 'admin') {
            $places = Place::paginate(10);
            return view('admin.places.index')->with(compact('places'));
        } else {
            $places = Place::where('user_id', $userId)->paginate(10);

            return view('admin.places.index')->with(compact('places'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = PlaceCategory::all();
        $places = Place::all();
        foreach ($places as $place){
            Place::where('id',$place->id)
                ->update([
                    'name_ro'=> str_slug($place->title_ro),
                    'name_ru'=> str_slug($place->title_ru),
                ]);
            $category = $categories->where('id',$place->category_id)->first();
            $fTextDataRo =str_slug($place->title_ro . ' ' . $place->description_ro . ' ' . $category['name_ro']);
            Place::where('id',$place->id)
                ->update([
                    'full_text_data_ro' => implode(",",explode('-',$fTextDataRo)),
                ]);
            $fTextDataRu =str_slug($place->title_ru . ' ' . $place->description_ru . ' ' . $category['name_ru']);
            Place::where('id',$place->id)
                ->update([
                    'full_text_data_ru' => implode(",",explode('-',$fTextDataRu)),
                ]);
        }

        return view('admin.places.create')->with(compact('categories'));
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
            'coords-long' => 'required',
            'coords-lat' => 'required',
        ]);
        $categories = PlaceCategory::all();
        $parentID = PlaceCategory::where('name_ro', $request['parent-id'])
            ->orWhere('name_ru', $request['parent-id'])
            ->first()['id'];

        $userId = Auth::user()->getAuthIdentifier();
        $category = $categories->where('id',$request->category_id)->first();
        $fTextDataRo =str_slug($request->title_ro . ' ' . $request->description_ro . ' ' . $category['name_ro']);
        $fTextDataRu =str_slug($request->title_ru . ' ' . $request->description_ru . ' ' . $category['name_ru']);
        $place = Place::create([
            'name_ro' =>  str_slug($request->get('title-ro')),
            'name_ru' => str_slug($request->get('title-ru')),
            'coords_long' => $request->get('coords-long'),
            'coords_lat' => $request->get('coords-lat'),
            'title_ro' => $request->get('title-ro'),
            'title_ru' => $request->get('title-ru'),
            'is_closed' => $request->get('is-closed'),
            'user_id' => $userId,
            'description_ro' => $request['description-ro'],
            'description_ru' => $request['description-ru'],
            'website' => $request['website'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'category_id' => $parentID,
            'status' => 0,
            'full_text_data_ro' => $fTextDataRo,
            'full_text_data_ru' => $fTextDataRu,
        ]);

        $mediaFilesPath = $request['media-files'];

        if ($mediaFilesPath) {
            foreach ($mediaFilesPath as $tempPath) {
                $name = Str::of($tempPath)->basename();
                $path = "images/$name";

                if (Storage::disk('public')->move($tempPath, "/$path")) {
                    $mediaFile = new MediaFile();
                    $mediaFile->file_path = $path;
                    $mediaFile->model_id = $place->id;
                    $mediaFile->model_type = MediaFile::MODEL_TYPE_PLACE;
                    $mediaFile->type_id = MediaFile::TYPE_IMAGE;
                    $mediaFile->save();
                }
            }
        }
        return redirect('/admin/places')->with('success', 'Place data successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $userId = Auth::user()->getAuthIdentifier();
        $place = Place::where('id', $id)->firstOrFail();
        $categories = PlaceCategory::all();
        $coords [] = $place->coords_long;
        $coords [] = $place->coords_lat;


        if (Auth::user()->hasRole('editor') && $userId !== $place->user_id) {
            return redirect('/admin/places');
        }
        $medias = MediaFile::where('model_type', 'place')->where('model_id', $id)->get();
        return view('admin.places.edit', ['points' => $coords])->with(compact('place', 'medias', 'categories'));
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

        $userId = Auth::user()->getAuthIdentifier();
        $place = Place::where('id', $id)->firstOrFail();
        if (Auth::user()->hasRole('editor') && $userId !== $place->user_id) {
            return redirect('/admin/places');
        }

        $request->validate([
            'title-ro' => 'required',
            'title-ru' => 'required',
            'coords-long' => 'required',
            'coords-lat' => 'required',
        ]);
        $categories = PlaceCategory::all();
        $category = $categories->where('id',$request->category_id)->first();
        $fTextDataRo =str_slug($request->title_ro . ' ' . $request->description_ro . ' ' . $category['name_ro']);
        $fTextDataRu =str_slug($request->title_ru . ' ' . $request->description_ru . ' ' . $category['name_ru']);

        $parentID = PlaceCategory::where('name_ro', $request['parent-id'])
            ->first()['id'];
        Place::where('id', $id)
            ->update([
                'name_ro' => str_slug($request->get('title-ro')),
                'name_ru' => str_slug($request->get('title-ru')),
                'coords_long' => $request->get('coords-long'),
                'coords_lat' => $request->get('coords-lat'),
                'title_ro' => $request->get('title-ro'),
                'title_ru' => $request->get('title-ru'),
                'is_closed' => $request->get('is-closed'),
                'description_ro' => $request['description-ro'],
                'description_ru' => $request['description-ru'],
                'website' => $request['website'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'category_id' => $parentID,
                'status' => 0,
                'full_text_data_ro' => $fTextDataRo,
                'full_text_data_ru' => $fTextDataRu,
            ]);

        $currentMediaFiles = MediaFile::where('model_id', $id)
            ->where('model_type', MediaFile::MODEL_TYPE_PLACE)
            ->pluck('file_path');

        $updatedMediaFiles = $request['media-files'];

        if (empty($updatedMediaFiles)) {
            foreach ($currentMediaFiles as $currentMediaFile) {
                MediaFile::where('file_path', $currentMediaFile)
                    ->where('model_type', MediaFile::MODEL_TYPE_PLACE)
                    ->delete();
                Storage::disk('public')->delete($currentMediaFile);
            }
        } else {
            $deletedMediaFiles = array_diff($currentMediaFiles->all(), $updatedMediaFiles);
            if ($deletedMediaFiles) {
                Storage::disk('public')->delete($deletedMediaFiles);
                foreach ($deletedMediaFiles as $deletedMediaFile) {
                    MediaFile::where('file_path', $deletedMediaFile)
                        ->where('model_type', MediaFile::MODEL_TYPE_PLACE)
                        ->delete();
                }
            }

            $addedMediaFiles = array_diff($updatedMediaFiles, $currentMediaFiles->all());
            if ($addedMediaFiles) {
                foreach ($addedMediaFiles as $addedMediaFile) {
                    $name = Str::of($addedMediaFile)->basename();
                    $path = "images/$name";

                    if (Storage::disk('public')->move($addedMediaFile, "/$path")) {
                        $mediaFile = new MediaFile();
                        $mediaFile->file_path = $path;
                        $mediaFile->model_id = $place->id;
                        $mediaFile->model_type = MediaFile::MODEL_TYPE_PLACE;
                        $mediaFile->type_id = MediaFile::TYPE_IMAGE;
                        $mediaFile->save();
                    }
                }
            }
        }

        return redirect('/admin/places')->with('success', 'Place data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id,$status)
    {
if ($status == "remove"){
    Place::where('id', $id)
        ->update([
            'status' => 1,
        ]);
} else {
    Place::where('id', $id)
        ->update([
            'status' => 0,
        ]);
}

        return redirect('/admin/places');
    }

}
