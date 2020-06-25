<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostViews extends Model
{
//    public static function ppost($id)
//    {
//         $pop = Post::where('ID','=',$id)->get()->first();
//    }
    public function post()
    {
        return $this->hasOne('app\Model\Post', 'ID','post_id');
    }
}
