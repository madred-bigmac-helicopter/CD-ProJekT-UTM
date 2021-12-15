<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TODO: Add the attributes that are mass assignable
    protected $fillable = [
        'name_ro',
        'name_ru',
        'parent_id',
    ];
}
