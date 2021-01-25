<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'hours' => 'collection',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
