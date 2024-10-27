<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionCategory extends Model
{
    use HasFactory;

    protected $table = 'competition_category';

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
