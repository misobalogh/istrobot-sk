<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'competition_category');
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
