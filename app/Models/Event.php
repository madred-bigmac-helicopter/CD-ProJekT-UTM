<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
    use HasFactory;

    public $asYouType = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TODO: Add the attributes that are mass assignable
    protected $fillable = [
        'name_ro',
        'name_ru',
        'price',
        'start_time',
        'end_time',
        'title_ro',
        'title_ru',
        'phone_reservation',
        'user_id',
        'description_ro',
        'description_ru',
        'full_text_data_ro',
        'full_text_data_ru',
        'category_id',
        'place_id'

    ];

    /**
     * Get the place associated with the event.
     */
    public function place()
    {
        return $this->hasOne(Place::class);
    }

    /**
     * Get the user that owns the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class, 'model_id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
//    public function toSearchableArray()
//    {
//        $array = $this->toArray();
//
//        return $array;
//    }
}
