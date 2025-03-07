<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

     public function rankings()
    {
        return $this->hasMany(KeywordRanking::class);
    }
}
