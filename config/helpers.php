<?php
/**
 * Created by PhpStorm.
 * User: Awsaf
 * Date: 5/5/2017
 * Time: 11:11 PM
 */


function requireToVar($file){
    ob_start();
    require($file);
    return ob_get_clean();
}

function getTime($val) {
    return $val > 12 ? $val - 12 . ' PM' : $val . ' AM';
}

function for_select($objects, $id= 'id', $name = 'name') {
    $ret = [];
    foreach ($objects as $object) {
        $ret[$object[$id]] = $object[$name];
    }
    return $ret;
}

function time_select() {
    $ret = [];
    for ($i = 1; $i < 25; $i++) {
        if($i < 13) {
            $ret[$i] = $i . ' AM';
        } else {
            $ret[$i] = ($i - 12) . ' PM';
        }
    }
    return $ret;

}
function list_for( $label, $min = 0, $max = 10, $step = 1) {
    $ret = [];
    for($i = $min; $i <= $max; $i += $step) {
        $ret[$i] = $i . ' ' . $label;
    }
    return $ret;
}

function getSQL($builder) {
    $sql = $builder->toSql();
    foreach ( $builder->getBindings() as $binding ) {
        $value = is_numeric($binding) ? $binding : "'".$binding."'";
        $sql = preg_replace('/\?/', $value, $sql, 1);
    }
    return $sql;
}

function blog_img($img, $version = null) {
    if($version) {

        $ext = pathinfo($img, PATHINFO_EXTENSION);

        $name = preg_replace( '/.' . $ext . '$/', '', $img);

        if($version == 'large') {
            $img = $name . '-1440x583.' . $ext;
        } elseif($version == 'small') {
            $img = $name . '-150x150.' . $ext;
        } elseif($version == 'featured-big') {
            $img = $name . '-565x564.' . $ext;
        } elseif($version == 'featured-medium') {
            $img = $name . '-586x259.' . $ext;
        } elseif($version == 'featured-small') {
            $img = $name . '-282x282.' . $ext;
        } else {
            $img = $name . '-542x295.' . $ext;
        }

    }
    return env('BLOG_URL', 'http://blogmuzbnb.dreamhosters.com') . '/wp-content/uploads/' . $img;

}