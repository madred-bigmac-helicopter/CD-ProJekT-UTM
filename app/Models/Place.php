<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Place extends Model
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
        'title_ro',
        'title_ru',
        'coords_long',
        'coords_lat',
        'is_closed',
        'user_id',
        'website',
        'email',
        'phone',
        'description_ro',
        'description_ru',
        'address',
        'full_text_data_ro',
        'full_text_data_ru',
        'category_id',
        'status',

    ];

    /**
     * Get the user that owns the place.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that owns the place.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
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

}
