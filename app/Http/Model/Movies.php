<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table='blog_movie';
    protected $primaryKey='movie_id';
    public $timestamps=false;
    protected $guarded=[];
}
