<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_SK',
        'name_EN',
        'type_of_evaluation',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_category');
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
