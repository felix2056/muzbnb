<?php

namespace App\Model;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['user_id', 'message', 'url', 'type', 'inc_val', 'admin_notice'];

    public static function addNew($userId, $msg, $url, $type = null, $incVal = null, $addS= false)
    {
        if($type && $incVal) {
            $nt = self::where(['user_id'=> $userId])->whereNull('seen')->orderBy('id', 'desc')->limit(1)->first();
            if($nt && $nt->type == $type) {
                $nt->inc_val = $nt->inc_val + $incVal;
                $nt->message = str_replace('COUNT', $nt->inc_val, $msg);
                if($addS) {
                    $nt->message .= 's';
                }
                $nt->save();
            } else {
                self::create(['user_id'=> $userId, 'message'=>str_replace('COUNT', $incVal, $msg), 'url'=>$url, 'type'=>$type, 'inc_val' => $incVal]);
            }
        } else {
            if($userId == 'admins') {
                $admins = Admin::all();
                foreach ($admins as $admin) {
                    self::create(['user_id' => $admin->id, 'message' => $msg, 'url' => $url, 'admin_notice' => true]);
                }
            } else {
                self::create(['user_id' => $userId, 'message' => $msg, 'url' => $url]);
            }
        }
    }
}
