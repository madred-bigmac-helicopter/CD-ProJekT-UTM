<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $webExploitation = 0;
    public $cryptography = 1;
    public $reverseEngineering = 2;
    public $forensics = 3;
    public $generalSkills = 4;
    public $binaryExploitation = 5;
    public $uncategorized = 6;
}
