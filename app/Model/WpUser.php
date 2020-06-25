<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WpUser extends Model
{
    protected $table = 'wp_users';

    protected $data = [];

    public function metas()
    {
        return $this->hasMany(WpUserMeta::class, 'user_id', 'ID');
    }

    public function picPost()
    {
        return $this->hasOne(Post::class, 'post_author', 'ID')->where('wp_posts.post_type', 'mt_pp');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_author', 'ID')->where('wp_posts.post_type', 'post')->where('post_status', 'publish');
    }

    public function meta($name)
    {
        if(empty($this->data)) {
            foreach ($this->metas as $meta) {
                $this->data[$meta->meta_key] = $meta->meta_value;
            }
        }

        if(isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return '';
        }
    }
}
