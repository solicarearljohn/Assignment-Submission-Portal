<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_value', // or 'value' if your column is named 'value'
        'description',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}