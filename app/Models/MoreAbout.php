<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class MoreAbout extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute',
        'description',
        'photo',
        'tags'
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class)->select(['name as text','id']);
    }
}
