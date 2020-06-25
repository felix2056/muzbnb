<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'ID';
    protected $table = 'wp_posts';

    public function author()
    {
        return $this->belongsTo(WpUser::class, 'post_author', 'ID');
    }

    public function image()
    {

        $p = DB::table('wp_posts as wp')
            ->leftJoin('wp_postmeta as meta1', 'meta1.post_id', '=', 'wp.ID' )
            ->leftJoin('wp_postmeta as meta2', 'meta2.post_id', '=', 'meta1.meta_value' )
            ->where('wp.ID', $this->ID)
            ->where('meta1.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select(['meta2.meta_value as image'])
            ->first();
        if($p) {
            return $p->image;
        } else {
            return '';
        }
    }



    public static function popularArticles($id = 0)
    {
        return DB::table('wp_posts as wp')
            ->leftJoin('wp_postmeta as meta1', 'meta1.post_id', '=', 'wp.ID' )
            ->leftJoin('wp_postmeta as meta2', 'meta2.post_id', '=', 'meta1.meta_value' )
            ->leftJoin('wp_postmeta as meta3', 'meta1.post_id', '=', 'wp.ID' )
            ->where('meta1.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->where('meta3.meta_key', '_aac_count_view')
            ->select(['wp.*', 'meta2.meta_value as image', 'meta3.meta_value as views'])
            ->where('wp.post_status', 'publish')
            ->where('wp.post_type', 'post')
            ->where('wp.ID', '!=', $id)
            ->orderBy('wp.post_date', 'asc')
            ->get();
    }
    public static function recentArticles($id = 0)
    {
        return DB::table('wp_posts as wp')
            ->leftJoin('wp_postmeta as meta1', 'meta1.post_id', '=', 'wp.ID' )
            ->leftJoin('wp_postmeta as meta2', 'meta2.post_id', '=', 'meta1.meta_value' )
            ->where('meta1.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select(['wp.*', 'meta2.meta_value as image'])
            ->where('wp.ID', '!=', $id)
            ->where('wp.post_status', 'publish')
            ->where('wp.post_type', 'post')
            ->orderBy('wp.post_date', 'desc')
            ->get();
    }

    public function relatedArticles()
    {
        $catArr = [];
        foreach ($this->categories() as $category) {
            $catArr[] = $category->term_id;
        }

        return DB::table('wp_posts as wp')
            ->join('wp_term_relationships as rel', 'wp.ID', '=', 'rel.object_id')
            ->leftJoin('wp_postmeta as meta1', 'meta1.post_id', '=', 'wp.ID' )
            ->leftJoin('wp_postmeta as meta2', 'meta2.post_id', '=', 'meta1.meta_value' )
            ->where('wp.ID', '!=', $this->ID)
            ->whereIn('rel.term_taxonomy_id', $catArr)
            ->where('meta1.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select(['wp.*', 'meta2.meta_value as image'])
            ->where('wp.post_status', 'publish')
            ->where('wp.post_type', 'post')
            ->groupBy('wp.ID')
            ->limit(3)
            ->get();
    }
    public function categories()
    {
        $categories = DB::table('wp_posts as wp')
            ->join('wp_term_relationships as rel', 'wp.ID', '=', 'rel.object_id')
            ->join('wp_terms as cat', 'rel.term_taxonomy_id', '=', 'cat.term_id')
            ->where('wp.ID', $this->ID)
            ->select('cat.*')
            ->get();
        return $categories;
    }

    public function isFeatured()
    {
        return $this->hasOne(PostMeta::class,'post_id', 'ID')->where('meta_key','_is_ns_featured_post');
    }

}
