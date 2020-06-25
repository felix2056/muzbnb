<?php
/**
 * Created by PhpStorm.
 * User: Awsaf
 * Date: 5/12/2017
 * Time: 5:41 PM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public $query;
    public $roomType;
    public $propertyType;
    public $no_of_bed;
    public $no_of_guest;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $country;
    public $zip_code;
    public $amenities = [];

    protected $fillable = ['query', 'lat', 'lng', 'room_type', 'no_of_guest', 'address1', 'address2', 'city', 'state', 'country', 'zip_code'];

//    public function customFill($arr)
//    {
//        $this->query = isset($arr['query']) ? $arr['query'] : '';
//        $this->lat = isset($arr['lat']) ? $arr['lat'] : '';
//        $this->lng = isset($arr['lng']) ? $arr['lng'] : '';
//        $this->room_type = isset($arr['room_type']) ?: '';
//        $this->no_of_guest = isset($arr['no_of_guest']) ?: '';
//        $this->address1 = isset($arr['address1']) ?: '';
//        $this->query = isset($arr['query']) ?: '';
//        $this->query = isset($arr['query']) ?: '';
//        $this->query = isset($arr['query']) ?: '';
//        $this->query = isset($arr['query']) ?: '';
//    }
}