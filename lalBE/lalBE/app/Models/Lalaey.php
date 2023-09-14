<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lalaey extends Model
{
    use HasFactory;

    protected $table = 'lalaeys';

    protected $fillable = ['Name', 'Lang', 'Type', 'Description', 'Audio_Path'];
}
