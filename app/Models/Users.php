<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\DB;

class Users extends Model
{
    protected $table = 'explore_api';
    protected $fillable = ['userId', 'id', 'title', 'body'];

    // public function insertData($data){
    //     DB::table('explore_api')->insert($data);
    // }
}
