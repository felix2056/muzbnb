<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'term_id';
    protected $table = 'wp_terms';

    public static function getPostsByCategory($slug)
    {
        return DB::table('wp_terms')
            ->join('wp_term_relationships as rel', 'rel.term_taxonomy_id', '=', 'wp_terms.term_id')
            ->join('wp_posts as wp', 'wp.ID', '=', 'rel.object_id')
            ->leftJoin('wp_postmeta as meta1', 'meta1.post_id', '=', 'wp.ID' )
            ->leftJoin('wp_postmeta as meta2', 'meta2.post_id', '=', 'meta1.meta_value' )
            ->where('wp.post_status', 'publish')
            ->where('wp.post_type', 'post')
            ->where('wp_terms.slug', $slug)
            ->where('meta1.meta_key', '_thumbnail_id')
            ->where('meta2.meta_key', '_wp_attached_file')
            ->select(['wp.*', 'meta2.meta_value as image'])->orderBy('post_date','desc')->get();
    }
    public static function getPostsByCategoryForPress($slug)
    {
        return DB::table('wp_terms')
            ->join('wp_term_relationships as rel', 'rel.term_taxonomy_id', '=', 'wp_terms.term_id')
            ->join('wp_posts as wp', 'wp.ID', '=', 'rel.object_id')
            ->leftJoin('wp_postmeta as meta3', function($join) {
                $join->on('meta3.post_id', '=', 'wp.ID');
                $join->on(DB::raw("meta3.meta_key"),'=', DB::raw("'sub-title'"));
            })
            ->leftJoin('wp_postmeta as meta4', function($join) {
                $join->on('meta4.post_id', '=', 'wp.ID');
                $join->on(DB::raw("meta4.meta_key"),'=', DB::raw("'url'"));
            })
            ->where('wp.post_status', 'publish')
            ->where('wp.post_type', 'post')
            ->where('wp_terms.slug', $slug)
            ->select(['wp.*', 'meta3.meta_value as sub_title', 'meta4.meta_value as url'])->orderBy('post_date','desc')->get();
    }
}
