<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MediaFileController extends Controller
{
    /**
     * store
     *
     * @param Request $request
     * @return string $path
     */
    public function store(Request $request)
    {
        if ($request->hasFile('media-files-uploader')) {
            if ($request->file('media-files-uploader')->isValid()) {

                $request->validate([
                    'media-file' => 'mimes:jpeg,png|max:1014',
                ]);

                $path = '/temp';
                $name = Carbon::now()->timestamp . rand();
                $extension = $request['media-files-uploader']->extension();

                $path = $request['media-files-uploader']->storeAs($path, "$name.$extension");

                return response()->json(['media-files-path' => $path]);
            }
        }
        abort(500, 'Could not upload file :(');
    }

}
