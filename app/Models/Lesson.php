<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TODO: Add the attributes that are mass assignable
    protected $fillable = [
        'title_ro',
        'title_ru',
        'place_id',
    ];

}
