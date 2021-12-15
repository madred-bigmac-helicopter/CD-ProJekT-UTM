<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    // Constants
    // ------------------------------------------------------
    const TYPE_IMAGE = 1;
    const TYPE_VIDEO = 2;
    const TYPE_EXTERNAL_LINK = 3;

    const MODEL_TYPE_PLACE = 'place';
    const MODEL_TYPE_EVENT = 'event';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'model_type',
        'model_id',
        'type_id',
        'file_path'
    ];

    public function place()
    {
        $this->belongsTo(Place::class);
    }

    public function event()
    {
        $this->belongsTo(Event::class);
    }
}
