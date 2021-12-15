<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\MediaFile;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userId = Auth::user()->getAuthIdentifier();
        if (Auth::user()->hasRole('admin')) {
            $events = Event::paginate(10);

            return view('admin.events.index')->with(compact('events'));
        } else {
            $events = Event::where('user_id', $userId)->paginate(10);
            return view('admin.events.index')->with(compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = EventCategory::all();
        $places = Place::where('user_id', Auth::id())->get();

        return view('admin.events.create')->with(compact('places', 'categories'));
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
            'name-ro' => 'required|unique:events,name_ro',
            'name-ru' => 'required|unique:events,name_ru',
            'title-ro' => 'required',
            'title-ru' => 'required',
            'start-time' => 'required',
            'end-time' => 'required',
            'price' => 'required',
            'phone-reservation' => 'required',

        ]);

        $parentID = EventCategory::where('parent_id', $request['parent-id'])
            ->first()['id'];
        $placeId = Place::where('name_ro', $request['place-id'])
            ->first()['id'];


        $event = Event::create([
            'name_ro' => $request['name-ro'],
            'name_ru' => $request['name-ru'],
            'price' => $request['price'],
            'start_time' => $request['start-time'],
            'end_time' => $request['end-time'],
            'title_ro' => $request['title-ro'],
            'title_ru' => $request['title-ru'],
            'phone_reservation' => $request['phone-reservation'],
            'user_id' => Auth::user()->getAuthIdentifier(),
            'description_ro' => $request['description-ro'],
            'description_ru' => $request['description-ru'],
            'category_id' => $parentID,
            'place_id' => $placeId,

        ]);

        $mediaFilesPath = $request['media-files'];

        if ($mediaFilesPath) {
            foreach ($mediaFilesPath as $tempPath) {
                $name = Str::of($tempPath)->basename();
                $path = "images/$name";

                if (Storage::disk('public')->move($tempPath, "/$path")) {
                    $mediaFile = new MediaFile();
                    $mediaFile->file_path = $path;
                    $mediaFile->model_id = $event->id;
                    $mediaFile->model_type = MediaFile::MODEL_TYPE_EVENT;
                    $mediaFile->type_id = MediaFile::TYPE_IMAGE;
                    $mediaFile->save();
                }
            }
        }

        return redirect('/admin/events')->with('success', 'Event data successfully created!');
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
        $event = Event::where('id', $id)->firstOrFail();
//        $categories = EventCategory::all();
        $places = Place::where('user_id', Auth::id())->get();

        $medias = MediaFile::where('model_type', 'event')->where('model_id', $id)->get();
        if (Auth::user()->hasRole('editor') && $userId !== $event->user_id) {
            return redirect('/admin/events');
        }

        return view('admin.events.edit')->with(compact('event', 'medias', 'places'));
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
        $event = Event::where('id', $id)->firstOrFail();
        if (Auth::user()->hasRole('editor') && $userId !== $event->user_id) {
            return redirect('/admin/events');
        }
        $request->validate([
            'name-ro' => 'required|unique:events,name_ro,' . $id,
            'name-ru' => 'required|unique:events,name_ru,' . $id,
            'title-ro' => 'required',
            'title-ru' => 'required',
            'start-time' => 'required',
            'end-time' => 'required',
            'price' => 'required',
            'phone-reservation' => 'required',

        ]);

        $parentID = EventCategory::where('name', $request['parent-id'])
            ->first()['id'];


        Event::where('id', $id)
            ->update([
                'name_ro' => $request['name-ro'],
                'name_ru' => $request['name-ru'],
                'price' => $request['price'],
                'start_time' => $request['start-time'],
                'end_time' => $request['end-time'],
                'title_ro' => $request['title-ro'],
                'title_ru' => $request['title-ru'],
                'phone_reservation' => $request['phone-reservation'],
                'description_ro' => $request['description-ro'],
                'description_ru' => $request['description-ru'],
                'category_id' => $parentID,
                'place_id' => $request['place-id'],
            ]);
        $currentMediaFiles = MediaFile::where('model_id', $id)
            ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
            ->pluck('file_path');

        $updatedMediaFiles = $request['media-files'];

        if (empty($updatedMediaFiles)) {
            foreach ($currentMediaFiles as $currentMediaFile) {
                MediaFile::where('file_path', $currentMediaFile)
                    ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
                    ->delete();
                Storage::disk('public')->delete($currentMediaFile);
            }
        } else {
            $deletedMediaFiles = array_diff($currentMediaFiles->all(), $updatedMediaFiles);
            if ($deletedMediaFiles) {
                Storage::disk('public')->delete($deletedMediaFiles);
                foreach ($deletedMediaFiles as $deletedMediaFile) {
                    MediaFile::where('file_path', $deletedMediaFile)
                        ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
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
                        $mediaFile->model_id = $event->id;
                        $mediaFile->model_type = MediaFile::MODEL_TYPE_EVENT;
                        $mediaFile->type_id = MediaFile::TYPE_IMAGE;
                        $mediaFile->save();
                    }
                }
            }
        }
        return redirect('/admin/events')->with('success', 'Event data successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public
    function destroy($id)
    {
        $currentMediaFiles = MediaFile::where('model_id', $id)
            ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
            ->pluck('file_path');
        foreach ($currentMediaFiles as $currentMediaFile)
            Storage::disk('public')->delete($currentMediaFile);
        MediaFile::where('model_id', $id)
            ->where('model_type', MediaFile::MODEL_TYPE_EVENT)
            ->delete();
        Event::where('id', $id)
            ->delete();

        return redirect('/admin/events');
    }
}
