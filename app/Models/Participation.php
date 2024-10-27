<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $table = 'participations';

    protected $fillable = [
        'robot_id',
        'category_id',
        'competition_id',
        'start_number',
        'result',
    ];

    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
