<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    public static function generateSlug($title){
        return Str::slug($title, '-');
    }

    protected $fillable = [
        'title',
        'customer',
        'slug',
        'description',
        'cover_image',
        'type_id'
    ];

    public function type(){

        return $this->belongsTo( Type::class );

    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
