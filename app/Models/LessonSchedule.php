<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TODO: Add the attributes that are mass assignable
    protected $fillable = [
        'lesson_id',
        'day',
        'start_time',
        'end_time',
    ];

}
