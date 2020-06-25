<?php

namespace App\Model;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;
//use Nicolaslopezj\Searchable\SearchableTrait;

class Listing extends Model
{
    use SoftDeletes;
//    use SearchableTrait;
    const CANCELLATION_STRICT = 1;
    const CANCELLATION_UNDERSTANDING = 2;

    const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_BANNED = 3;

    public $amenities = [];

    protected $appends = ['room_type_display', 'listing_amenities'];

    public static function getPath ($name = 'images'){
        return base_path() . '/public/' . $name . '/listings/';
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    protected $fillable = [
        'name', 'description','property_type','room_type','no_of_guest','no_of_bedroom', 'no_of_bed','no_of_king_bed','no_of_queen_bed',
        'no_of_full_bed','no_of_twin_bed','no_of_couch_bed','no_of_airbed','no_of_bath','country','address1','address2',
        'city','state','zip_code','price','cancellation_type','minimum_night','maximum_night','check_in_time','check_out_time',
        'advanced_booking_time', 'currency_id', 'status', 'lat', 'lng','algolia_objectID'];

    protected $casts = [
        'lat' => 'double',
        'lng' => 'double',
        'status' => 'integer',
        'property_type' => 'integer',
        'room_type' => 'integer',
        'no_of_guest' => 'integer',
        'no_of_bedroom' => 'integer',
        'no_of_bed' => 'integer',
        'no_of_king_bed' => 'integer',
        'no_of_queen_bed' => 'integer',
        'no_of_full_bed' => 'integer',
        'no_of_twin_bed' => 'integer',
        'no_of_couch_bed' => 'integer',
        'no_of_airbed' => 'integer',
        'minimum_night' => 'integer',
        'maximum_night' => 'integer',
        'check_in_time' => 'integer',
        'check_out_time' => 'integer',
    ];
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'name' => 10,
            'description' => 5,
            'address1' => 10,
            'address2' => 10,
            'city' => 9,
            'state' => 8,
            'Country' => 7
        ],
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getListingAmenitiesAttribute() {
        return $this->options()->pluck('id')->toArray();
    }

    public function getRoomTypeDisplayAttribute() {
        //return $this->room_type == 1 ? 'Entire place' : '';
        if($this->room_type != null) {
            $arr = [
                1 => 'Entire place',
                2 => 'Private room',
                3 => 'Shared room'
            ];
            return $arr[$this->room_type];
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listingImage()
    {
        return $this->hasMany('App\Model\ListingImage', 'listing_id', 'id');
    }

//    public function events()
//    {
//        return $this->hasMany('App\Model\Event', 'listing_id', 'id');
//    }

    public function showFeaturedImage($version = null)
    {
        $fi = $this->featuredImage;
        if($fi) {
            return url('images/listings') . '/' . $version . '_' . $fi->name;
        } else {
            return '/style/assets/img/dubai.png';
        }
    }

    public function featuredImage()
    {
        return $this->hasOne(ListingImage::class)->where('listing_images.is_featured', true);
    }
    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }

    public function documents()
    {
        return $this->hasMany(ListingDocument::class);
    }
    public function events() {
        return $this->hasMany(Event::class);
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function options()
    {
        return $this->belongsToMany(ListingOption::class, 'listing_option_pivot', null,'option_id');
    }
    public function rules()
    {
        return $this->belongsToMany(ListingRule::class, 'listing_rule_pivot');
    }

    public function oldFeaturedImage()
    {
        if($this->id) {
            if($this->featuredImage){
                return $this->featuredImage->show('s');
            }
        }
        return '';
    }
    public function oldImages()
    {
        if($this->id) {
            $images = $this->images()->where('listing_images.is_featured', false)->get();
            if($images->first()){
                $imgs = [];
                foreach ($images as $image) {
                    $imgs[] = $image->show('s');
                }
                return implode(';', $imgs);
            }
        }
        return '';
    }
    public static function propertyOptions($index = null)
    {
        $arr = [
            1 => 'Apartment',
            2 => 'Boat',
            3 => 'Cabin',
            4 => 'Condo',
            5 => 'Duplex',
            6 => 'Estate',
            7 => 'Guesthouse',
            8 => 'House',
            9 => 'Loft',
            10 => 'Studio',
            11 => 'Villa',
            12 => 'Yacht',
            13 => 'Hotel',
            14 => 'Resort',
        ];
        if($index) {
            return $arr[$index];
        }
        asort($arr);
        return $arr;
    }
    public static function roomTypeOptions($index = null)
    {
        $arr = [
            1 => 'Entire place',
            2 => 'Private room',
            3 => 'Shared room'
        ];
        if($index) {
            return $arr[$index];
        }
        return $arr;
    }

    public static function cancellationOptions($index = null)
    {
        $arr = [
            1 => 'Strict',
            2 => 'Understanding',
            3 => 'Moderate',
        ];
        if($index) {
            return $arr[$index];
        }
        return $arr;
    }

    public static function bookingOptions($index = null)
    {
        $arr = [
            1 => 'Any time',
            3 => '3 Months',
            6 => '6 Months',
            12 => '1 Year'
        ];
        if($index) {
            return $arr[$index];
        }
        return $arr;
    }

    public function savePhotos($photos, $featured = false)
    {
        if($featured) {
            $photo = $photos;
            $name = str_random(5) . '_' . $photo->getClientOriginalName();
            $path = self::getPath();
            $reeult =$photo->move($path, $name);
            $save = $this->images()->create(['name' => $name, 'is_featured'=> true]);
            \Image::make($path . $name)->fit(903, 480)->save($path . 'l_' . $name);
            \Image::make($path . $name)->fit(550, 299)->save($path . 'm_' . $name);
            \Image::make($path . $name)->fit(250, 190)->save($path . 's_' . $name);
        } else {
            $photosToUpload = \Cache::get('myfiles');
            foreach ($photosToUpload as $key => $name) {
                \Log::info('uploading photo');
                \Log::info($name);
                \Log::info('uploading photo');
//                $name = str_random(5) . '.' . $photo->getClientOriginalName();
//                $path = self::getPath();
//                $photo->move($path, $name);
                $this->images()->create(['name' => $name]);

//                Image::make($path . $name)->fit(903, 480)->save($path . 'l_' . $name);
//                Image::make($path . $name)->fit(250, 190)->save($path . 's_' . $name);
            }
        }
    }

    public function saveFiles($files)
    {
        foreach($files as $file){
            $name = str_random(5).'.'.$file->getClientOriginalName();
            $path = self::getPath('files');

            $file->move($path, $name);
            $this->documents()->create(['name'=>$name]);

        }
    }

    public function findAmenities($type)
    {
        $all = $this->options()->where('listing_option.type', $type)->get();
        $ret =[];
        foreach ($all as $a) {
            $ret[] = $a->name;
        }
        return $ret;
    }
}
/* for future
DB::table('rooms')
                     ->distinct()
                     ->leftJoin('bookings', function($join)
                         {
                             $join->on('rooms.id', '=', 'bookings.room_type_id');
                             $join->on('arrival','>=',DB::raw("'2012-05-01'"));
                             $join->on('arrival','<=',DB::raw("'2012-05-10'"));
                             $join->on('departure','>=',DB::raw("'2012-05-01'"));
                             $join->on('departure','<=',DB::raw("'2012-05-10'"));
                         })
                     ->where('bookings.room_type_id', '=', NULL)
                     ->get();
 * */