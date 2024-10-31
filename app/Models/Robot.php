<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_first_name',
        'author_last_name',
        'coauthors',
        'processor',
        'memory_size',
        'frequency',
        'sensors',
        'drive',
        'power_supply',
        'programming_language',
        'interesting_facts',
        'website',
        'description',
        'user_id',
        'technology_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
