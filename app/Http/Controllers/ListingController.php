<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Currency;
use App\Model\Event;
use App\Model\Listing;
use App\Model\ListingImage;
use App\Model\ListingOption;
use App\Model\ListingRule;
use App\Model\Search;
use App\Services\GeneralServices;
use Dompdf\Image\Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\HomeController;
use App\Mail\MasterMail;
use App\Http\Controllers\SparkController;
//use App\AlgoliaSearch;
use App\Model\UserProfile;

class ListingController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        $this->HomeController = new HomeController();
        $this->SparkController= new SparkController();
        //$this->AlgoliaSearch  = new AlgoliaSearch();
        $this->lsiting = new Listing();
        // $this->middleware('auth');
    }

    public function becomeHost()
    {
        return view('listing.host');
    }

    public function becomeHost2()
    {
        return view('listing.host2');
    }

    public function create()
    {
        try {
            if (count(\Cache::get('myfiles')) > 0) {
                $arr = new Collection();
                \Cache::store('file')->put('myfiles', $arr, 10);
            }
        }catch (\Exception $e) {

        }
        $listing = new Listing();
        $options = ListingOption::getAll();
        $rules = ListingRule::whereNull('listing_id')->get();
        $currentRules = [];
        $currencies = Currency::all();
        $events = [];
        $profile = UserProfile::where('user_id',Auth::user()->id)->get()->first();
        $edit=false;
        return view('listing.editor', compact('options', 'rules', 'currencies', 'listing', 'currentRules', 'events' ,'profile', 'edit'));
    }

    /**
     *   Single Listing
     *
     * @return \Illuminate\Http\Response
     */

    public function editImages($id)
    {
        $listing = Listing::with('user.profile', 'listingImage')->findOrFail($id);
        return collect([
            'status' => 'success',
            'images' => $listing->listingImage
        ]);
    }

    public function edit($id)
    {

        try {
            if (count(\Cache::get('myfiles')) > 0) {
                $arr = new Collection();
                \Cache::store('file')->put('myfiles', $arr, 10);
            }
        }catch (\Exception $e) {

        }

        $listingId = $id;
        $listing = Listing::with('user.profile', 'listingImage')->findOrFail($id);

        if($listing->user_id == auth()->id()) {
            $options = ListingOption::getAll();
            $rules = ListingRule::whereNull('listing_id')->orWhere('listing_id', $id)->get();

            foreach($listing->options as $op) {
                $listing->amenities[] = $op->id;
            }
            $currentRules = [];
            foreach($listing->rules as $rule) {
                $currentRules[] = $rule->id;
            }
            $currencies = Currency::all();
            $events = [];
            foreach ($listing->events as $event) {
                $events[] = [
                    'dbId' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start,
                    'end' => $event->end
                ];
            }
            $profile = UserProfile::where('user_id',Auth::user()->id)->get()->first();
            $edit = true;
            $images = ($listing->listingImage->toJson());


            return view('listing.editor', compact('options', 'rules', 'currencies', 'listing', 'currentRules', 'events' ,'profile', 'edit', 'images', 'listingId'));
        } else {
            abort(404);
        }

    }

    public function save(Request $request)
    {
        if(strlen($request->name) < 2 ) {
            $request['name'] = 'Untitled';
        }
        $ca = [
            'address1' => 'Street address',
            'address2' => 'APT, SUITE. BLOG',
        ];
        $this->validate($request,[
            'name' => 'string|nullable',
            'description' => 'string|nullable',
            'property_type' => 'integer|nullable',
            'room_type' => 'integer|nullable',
            'no_of_guest' => 'integer|nullable',
            'no_of_bedroom' => 'integer|nullable',
            'no_of_king_bed' => 'integer|nullable',
            'no_of_queen_bed' => 'integer|nullable',
            'no_of_full_bed' => 'integer|nullable',
            'no_of_twin_bed' => 'integer|nullable',
            'no_of_couch_bed' => 'integer|nullable',
            'no_of_airbed' => 'integer|nullable',
            'no_of_bath' => 'numeric|nullable',
            'country' => 'string|nullable',
            'address1' => 'string|nullable',
            'address2' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|nullable',
            'zip_code' => 'string|nullable',
            'price' => 'numeric|nullable',
            'cancellation_type' => 'integer|nullable',
            'minimum_night' => 'integer|nullable',
            'maximum_night' => 'integer|nullable',
            'check_in_time' => 'integer|nullable',
            'check_in_time_from' => 'integer|nullable',
            'check_in_time_to' => 'integer|nullable',
            'check_out_time' => 'integer|nullable',
            'check_out_time_from' => 'integer|nullable',
            'check_out_time_to' => 'integer|nullable',
            'advanced_booking_time' => 'integer|nullable',
            'currency_id' => 'integer|nullable',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',
            'amenities' => 'array',
            'all_rules' => 'array',
            'custom_rules' => 'array',
            'status' => 'integer',
            'photos.*' => 'image',
            'featured' => 'image',
            'docs.*' => 'file|mimes:jpeg,bmp,png,jpg,doc,docx,pdf,txt,zip',
        ], [], $ca);
        $listing = Listing::create($request->except('_token', 'events', 'deleted-events'));


        $listing->check_in_time_from  = $request->check_in_time_from;
        $listing->check_in_time_to    = $request->check_in_time_to;
        $listing->check_out_time_from = $request->check_out_time_from;
        $listing->check_out_time_to   = $request->check_out_time_to;
        $listing->save();


        if($listing->status == 1) {
            $listing->published_at = Carbon::now()->toDayDateTimeString();
            $listing->save();
        }
        if($request->getstus == 2) {
            $listing->status = 2;
            $listing->published_at = null;
            $listing->save();
        }

        $events = json_decode($request->events);

        if(is_array($events) && !empty($events)) {
            foreach ($events as $event) {
                $e = new Event();
                $e->title = 'Unavailable';
                $e->start = $event->start;
                $e->end = $event->end;
                $listing->events()->save($e);
            }
        }
        if(is_array($request->amenities)) {
            foreach ($request->amenities as $amenity) {
                $a = ListingOption::find($amenity);
                $listing->options()->save($a);
            }
        }
        if(is_array($request->all_rules)) {
            foreach ($request->all_rules as $rule=>$v) {
                if($v> 0) {
                    $r = ListingRule::find($rule);
                    $listing->rules()->save($r);
                }
            }
        }


        if ($request->featured){
            $photo = $request->file('featured');
            $imagename =  time().str_random(5).'.'.$photo->getClientOriginalExtension();
            $destinationPath = public_path('/images/listings');
            $imagesfile = file_get_contents($photo->getRealPath());

            $thumb_img = \Image::make($imagesfile);
            $thumb_img = $thumb_img->resize(250, 190);
            $thumb_img->save($destinationPath.'/s_'.$imagename,80);
            $thumb_img = \Image::make($imagesfile)->resize(550, 299);
            $thumb_img->save($destinationPath.'/m_'.$imagename,80);

            $thumb_img = \Image::make($imagesfile)->resize(903, 480);
            $thumb_img->save($destinationPath.'/l_'.$imagename,80);

            $listing->images()->create(['name' => $imagename, 'is_featured'=> true]);
            $photo->move($destinationPath, $imagename);

        }

        if(count(\Cache::get('myfiles')) > 0) {
            $listing->savePhotos($request->photos);
        }
        if(is_array($request->custom_rules)) {
            foreach ($request->custom_rules as $rule) {
                $r = ListingRule::create(['name'=>$rule, 'listing_id'=>$listing->id]);
                $listing->rules()->save($r);
            }
        }
        if(is_array($request->docs)) {
            $listing->saveFiles($request->docs);
        }

        $viewlistinglink   = route('room',$listing->id );
        $managelistinglink = route('my-listings');
        $templates = $this->SparkController->getSparkTemplateId('CreateListingEmail', Auth::user()->email, auth()->user()->first_name ,'', $viewlistinglink,$managelistinglink);

        $request->session()->flash('success', 'Listing Saved Successfully');

		    return redirect('/congrats/'.$listing->id);


    }

    public function update($id, Request $request)
    {
        $listing = Listing::findOrFail($id);

        if(strlen($request->name) < 2 ) {
            $request['name'] = 'Untitled';
        }
        $ca = [
            'address1' => 'Street address',
            'address2' => 'APT, SUITE. BLOG',
        ];
        $this->validate($request,[
            'name' => 'string|nullable',
            'description' => 'string|nullable',
            'property_type' => 'integer|nullable',
            'room_type' => 'integer|nullable',
            'no_of_guest' => 'integer|nullable',
            'no_of_bedroom' => 'integer|nullable',
            'no_of_king_bed' => 'integer|nullable',
            'no_of_queen_bed' => 'integer|nullable',
            'no_of_full_bed' => 'integer|nullable',
            'no_of_twin_bed' => 'integer|nullable',
            'no_of_couch_bed' => 'integer|nullable',
            'no_of_airbed' => 'integer|nullable',
            'no_of_bath' => 'numeric|nullable',
            'country' => 'string|nullable',
            'address1' => 'string|nullable',
            'address2' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|nullable',
            'zip_code' => 'string|nullable',
            'price' => 'numeric|nullable',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable',
            'cancellation_type' => 'integer|nullable',
            'minimum_night' => 'integer|nullable',
            'maximum_night' => 'integer|nullable',
            'check_in_time' => 'integer|nullable',
            'check_in_time_from' => 'integer|nullable',
            'check_in_time_to' => 'integer|nullable',
            'check_out_time' => 'integer|nullable',
            'check_out_time_from' => 'integer|nullable',
            'check_out_time_to' => 'integer|nullable',
            'advanced_booking_time' => 'integer|nullable',
            'currency_id' => 'integer|nullable',
            'amenities' => 'array',
            'all_rules' => 'array',
            'custom_rules' => 'array',
            'status' => 'integer',
            'photos.*' => 'image',
            'featured' => 'image',
            'docs.*' => 'file|mimes:jpeg,bmp,png,jpg,doc,docx,pdf,txt,zip',
        ], [], $ca);


        $listing->check_in_time_from  = $request->check_in_time_from;
        $listing->check_in_time_to    = $request->check_in_time_to;
        $listing->check_out_time_from = $request->check_out_time_from;
        $listing->check_out_time_to   = $request->check_out_time_to;
        $listing->save();

        if($listing->status != 2 && $request->status == 2) {
            $listing->published_at = Carbon::now()->toDayDateTimeString();
            $listing->save();
        }
        $listing->update($request->except('_token', 'events', 'deleted-events'));


        $deletedEvents = json_decode($request->get('deleted-events'));

        if(is_array($deletedEvents) && !empty($deletedEvents)) {
            foreach ($deletedEvents as $event) {
                if($event > 0) {
                    $e = Event::find($event);
                    if($e) {
                        $e->delete();
                    }
                }
            }
        }
        $events = json_decode($request->events);
//        dd($events);
        if(is_array($events) && !empty($events)) {
            foreach ($events as $event) {
                if($event->dbId > 0) {
                    $e = Event::where('listing_id', $id)->where('id', $event->dbId)->firstOrFail();
                } else {
                    $e = new Event();
                }
                $e->title = 'Unavailable';
                $e->start = $event->start;
                $e->end = $event->end;
                $listing->events()->save($e);
            }
        }

        $listing->options()->detach();
        if(is_array($request->amenities)) {

            foreach ($request->amenities as $amenity) {
                $a = ListingOption::find($amenity);
                $listing->options()->save($a);
            }
        }
        $listing->rules()->detach();
        if(is_array($request->all_rules)) {
            foreach ($request->all_rules as $rule=>$v) {
                if($v> 0) {
                    $r = ListingRule::find($rule);
                    $listing->rules()->save($r);
                }
            }
        }

        if(is_array($request->custom_rules)) {
            foreach ($request->custom_rules as $rule) {
                $r = ListingRule::create(['name'=>$rule, 'listing_id'=>$id]);
                $listing->rules()->save($r);
            }
        }

        if ($request->featured){

            $photo = $request->file('featured');
            $imagename =  time().str_random(5).'.'.$photo->getClientOriginalExtension();
            $destinationPath = public_path('/images/listings');
            $imagesfile = file_get_contents($photo->getRealPath());

            $thumb_img = \Image::make($imagesfile);
            $thumb_img = $thumb_img->resize(250, 190);
            $thumb_img->save($destinationPath.'/s_'.$imagename,80);
            $thumb_img = \Image::make($imagesfile)->resize(550, 299);
            $thumb_img->save($destinationPath.'/m_'.$imagename,80);

            $thumb_img = \Image::make($imagesfile)->resize(903, 480);
            $thumb_img->save($destinationPath.'/l_'.$imagename,80);

            //$listing->images()->create(['name' => $imagename, 'is_featured'=> true]);
            $ListingImage =  ListingImage::where('listing_id', $id)->where('is_featured',1)->get();

            foreach ($ListingImage as $value){
                unlink($destinationPath.'/s_'.$value->name);
                unlink($destinationPath.'/m_'.$value->name);
                unlink($destinationPath.'/l_'.$value->name);
                unlink($destinationPath.'/'.$value->name);
            }
            if(count($ListingImage) > 1){
                ListingImage::where('listing_id', $id)->where('is_featured',1)->delete();
                $listing->images()->create(['name' => $imagename, 'is_featured'=> true]);
            }else{
                ListingImage::where('listing_id', $id)->where('is_featured',1)->update(['name' => $imagename]);
            }

            $photo->move($destinationPath, $imagename);
            // $listing->savePhotos($request->featured,true);
        }

        if(count(\Cache::get('myfiles')) > 0) {
            $listing->savePhotos($request->photos);
        }

        if(is_array($request->docs)) {
            $listing->saveFiles($request->docs);
        }
//        if(!empty($listing->algolia_objectID)){
//            $this->AlgoliaSearch->updateIndex($id , $request->amenities);
//        } else {
//            $this->AlgoliaSearch->saveIndex($id , $request->amenities);
//        }

        return redirect()->route('my-listings');
    }

    /**
     *   Single Listing
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $listing = Listing::with('user', 'events')->findOrFail($id);

        $options = ['amenity'=>[], 'spec'=>[], 'pet'=>[], 'space'=>[], 'safety'=>[]];

        foreach ($listing->options as $option) {
            $options[$option->type][] = $option->name;
        }
        $allRules = ListingRule::whereNull('listing_id')->orwhere('listing_id', $id)->get();
        $listingRules = [];
        foreach ($listing->rules as $rule) {
            $listingRules[] = $rule->id;
        }
        $datesToDisable = [];
        $res = [];
        foreach($listing->events as $key => $val){
            $datesToDisable[] = \Carbon\Carbon::parse($val->start)->format('Y-m-d');
            $datesToDisable[] = \Carbon\Carbon::parse($val->end)->format('Y-m-d');
        }
        $bookingDates = Booking::where('listing_id', '=', $listing->id)->where('status', '=', 2)->get();
        foreach($bookingDates as $booking){
                $res[] = self::generateDateRange(\Carbon\Carbon::parse($booking->date_from), \Carbon\Carbon::parse($booking->date_to));
        }
        foreach($res as $k => $v){
          foreach($v as $k1 => $v1){
            $datesToDisable[] = $v1;
          }
        }
        $datesToDisable = json_encode($datesToDisable);

        $listing->customDescription = self::breakLongText($listing->description);
        if($listing->status == Listing::STATUS_PUBLISHED || $listing->user_id == auth()->id()) {
            return view('listing.view', compact(['listing', 'options', 'allRules', 'listingRules', 'datesToDisable']));
        } else {
            abort(404);
        }

    }

    public function deleteImage($id, Request $request)
    {
        $listing = Listing::with('user')->findOrFail($id);

        if($listing->user_id == auth()->id()) {
            $name = substr(basename($request->img), 2);
            $path = Listing::getPath();
            if(file_exists($path . $name)) unlink($path . $name);
            if(file_exists($path . 'l_' . $name)) unlink($path . 'l_' . $name);
            if(file_exists($path . 'm_' . $name)) unlink($path . 'm_' . $name);
            if(file_exists($path . 's_' . $name)) unlink($path . 's_' . $name);
            ListingImage::where('name', $name)->first()->delete();
            return 'success';
        } else {
            return false;
        }
    }

    public function searchJson(Request $request)
    {
        if($request->ajax()){
            $qry = Listing::with('currency', 'featuredImage', 'user')->where('status', Listing::STATUS_PUBLISHED);

            if(strlen($request->state) > 0) {
                $qry->where('state', 'Like', '%' . trim(str_replace('Division', '', $request->state)) . '%');
            }
            if(strlen($request->country) > 0) {
                $qry->where('country', 'Like', $request->country);
            }
            if($request->no_of_guest > 0) {
                $qry->where('no_of_guest', '>=',$request->no_of_guest);
            }
//            if($request->check_in_date != '') {
//                $qry->where('>=', 'check_in_date', $request->check_in_date);
//            }
            if($request->price_min > 0) {
                $qry->where('price', '>=',$request->price_min);
            }
            if($request->price_max > 0) {
                $qry->where('price', '<=', $request->price_max);
            }
            if($request->room_type > 0) {
                $qry->where('room_type', $request->room_type);
            }
            if($request->amenities != '' && $request->amenities !== null) {
                $oids = DB::table('listing_option_pivot')->select('listing_id as id')->whereIn('option_id', explode(',', $request->amenities))->get();
                $orders = [];
                foreach ($oids as $o) {
                    $orders[] = $o->id;
                }
//                dd($oids);
                $qry->whereIn('id', $orders);
            }
            if($request->properties != '' && $request->properties !== null) {
                $qry->whereIn('property_type', explode(",", $request->properties));
            }
            $query = $request['query'];
            if(strlen($query) > 1) {
                $qry->whereRaw("MATCH (name,city,state,country,zip_code) AGAINST ('$query')");
//                if(strlen($request->city) > 0) {
//                    $qry->where('or', ['city', 'Like', $request->city], ['name', 'Like', '%' . $query . '%']);
//                } else {
//                    $qry->orWhere('name', 'Like', '%' . $query . '%');
//                }
//                $qry->search($query);
            } else {
                if(strlen($request->city) > 0) {
                    $qry->where('city', 'Like', $request->city);
                }
            }
            if($request->nelat) {
                $qry->orWhere('and', ['and', ['lat', '>', $request->nelat], ['lng', '<', $request->nelng]], ['and', ['lat', '<', $request->swlat], ['lng', '>', $request->swlng]]);
            }
            $paginator = $qry->paginate(20);
            $paginator->getCollection()->transform(function ($listing) {
                return [
                    'url' => route('room', $listing->id),
                    'name' => $listing->name,
                    'description' => str_limit($listing->description),
                    'symbol' => $listing->currency->symbol,
                    'lat' => $listing->lat,
                    'lng' => $listing->lng,
                    'price' => $listing->price,
                    'type' => Listing::roomTypeOptions($listing->room_type),
                    'city' => $listing->city,
                    'noOfHostReview' => '0',
                    'noOfBed' => $listing->no_of_bed,
                    'oldCustomers' => '',
                    'photo' => $listing->showFeaturedImage('m'),
                    'hostName' => $listing->user->first_name,
                    'userPhoto' => $listing->user->photo('s')
                ];
            })->reverse();
            return $paginator;
        }
    }


    public function searchListings(Request $request, $arg1=false, $arg2=false, $arg3=false, $lat=false, $lng=false) {
        if(isset($arg1) && $arg1 != null ) {
            $data = self::getAreaListings($request, $arg1, $arg2, $arg3, $lat, $lng);
            if(isset($request->check_in_date)){
//                dd($data['listings'][0]);
                $data2 = self::searchListingsFilter($data['listings'], $request);
                if($data2['status'] == 'success') {
                    $data['listings'] = $data2['listings'];
                    $data['mapListings'] = $data2['mapListings'];
                }
            }
            return view('listing.search', [
                'search' => $data['search'],
                'amenities' => $data['amenities'],
                'request' => $data['request'],
                'current' => $data['current'],
                'listings' => $data['listings'],
                'mapListings' => $data['mapListings'],
                'listingsJson' => $data['listingsJson']
            ]);
        } else {
            $data = self::getAllListings($request);
//            dd($data['listings'][0]);
            if(isset($request->check_in_date)){
                $data2 = self::searchListingsFilter($data['listings'], $request);
                if($data2['status'] == 'success') {
                    $data['listings'] = $data2['listings'];
                    $data['mapListings'] = $data2['mapListings'];
                }
            }
            return view('listing.search', [
                'search' => $data['search'],
                'amenities' => $data['amenities'],
                'request' => $data['request'],
                'current' => $data['current'],
                'listings' => $data['listings'],
                'mapListings' => $data['mapListings'],
                'listingsJson' => $data['listingsJson']
            ]);
        }
    }

    public function getAllListings($request) {
        try {
            $search = new Search();
            $search->fill($request->all());
            $amenities = [];
            $options = ListingOption::all();
            foreach ($options as $option) {
                $amenities[$option->id] = $option->name;
            }
            $current['amenities'] = explode(',', $request->amenities);
            $current['properties'] = explode(',', $request->properties);
            $search->getAttributes();
            $listings = Listing::where('status', '=', 2)->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
//            dd($listings);
            $data = [];
            foreach($listings as $listing) {
                $temp = [];
                $temp['id'] = $listing->id;
                $temp['name'] = $listing->name;
                if(isset($listing->featuredImage) && $listing->featuredImage->name != '') {
                    $temp['photo'] = $listing->featuredImage->name;
                } else {
                    $temp['photo'] = '';
                }
                $temp['symbol'] = $listing->currency->symbol;
                $temp['price'] = (int)$listing->price;
                $temp['lat'] = $listing->lat;
                $temp['lng'] = $listing->lng;
                array_push($data, $temp);
//                $data->push($temp);
            }

            $mapListings = json_encode($data);
            $listingsJson = $listings->toJson();

            return collect([
                'search' => $search,
                'amenities' => $amenities,
                'request' => $request,
                'current' => $current,
                'listings' => $listings,
                'mapListings' => $mapListings,
                'listingsJson' => $listingsJson
            ]);
            //return view('listing.search', compact('search', 'amenities', 'request', 'current', 'listings', 'mapListings'));
        } catch (\Exception $e) {
            \Log::info('>>>>>>>>>>>>>>>>>> Error in search function in ListingController >>>>>>>>>>>>>>>>>');
            \Log::info('Message: ' . $e->getMessage());
            \Log::info('Line: ' . $e->getLine());
            \Log::info('Code: ' . $e->getCode());
            \Log::info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
        }
    }

    public function getAreaListings($request, $arg1, $arg2, $arg3, $lat, $lng) {
        try {
            $prefix = $str = '';
            $search = new Search();
            $search->fill($request->all());
            $amenities = [];
            $options = ListingOption::all();
            foreach ($options as $option) {
                $amenities[$option->id] = $option->name;
            }
            $current['amenities'] = explode(',', $request->amenities);
            $current['properties'] = explode(',', $request->properties);
            $search->getAttributes();
            $data = [];

            if ($lat && $lng && $lat != '' && $lng != '') {
                $records = DB::select('SELECT id, ( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin(radians(lat)) ) ) AS distance  FROM listings WHERE lat IS NOT NULL AND `status` = 2 HAVING distance < 100 ORDER BY distance');
                foreach($records as $record) {
                    $str .= $prefix . '' . $record->id . '';
                    $prefix = ', ';
                }
                $rec = explode(',', $str);
                $listings = Listing::whereIn('id', $rec)->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
            } else {
                if (isset($arg1) && isset($arg2) && isset($arg3) && $arg1 != '' && $arg2 != '' && $arg3 != '') {
                    $listings = Listing::where([
                        ['status', '=', 2],
                        ['country', '=', $arg1],
                        ['state', '=', $arg2],
                        ['city', '=', $arg3]
                    ])->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
                } elseif (isset($arg1) && isset($arg2) && $arg1 != '' && $arg2 != '') {
                    $listings = Listing::where([
                        ['status', '=', 2],
                        ['country', '=', $arg1],
                        ['state', '=', $arg2]
                    ])->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
                } else {
                    $listings = Listing::where([
                        ['status', '=', 2],
                        ['country', '=', $arg1]
                    ])->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
                }
            }

            foreach($listings as $listing) {
                $temp = [];
                $temp['id'] = $listing->id;
                $temp['name'] = $listing->name;
                if(isset($listing->featuredImage) && $listing->featuredImage->name != '') {
                    $temp['photo'] = $listing->featuredImage->name;
                } else {
                    $temp['photo'] = '';
                }
                $temp['symbol'] = $listing->currency->symbol;
                $temp['price'] = (int)$listing->price;
                $temp['lat'] = $listing->lat;
                $temp['lng'] = $listing->lng;
                array_push($data, $temp);
//                $data->push($temp);
            }
//            dd($data);
//            dd($listings[12]);
            $mapListings = json_encode($data);
            $listingsJson = $listings->toJson();
            return collect([
                'search' => $search,
                'amenities' => $amenities,
                'request' => $request,
                'current' => $current,
                'listings' => $listings,
                'mapListings' => $mapListings,
                'listingsJson' => $listingsJson
            ]);
            //return view('listing.search', compact('search', 'amenities', 'request', 'current', 'listings', 'mapListings'));
        } catch (\Exception $e) {
            \Log::info('>>>>>>>>>>>>>>>>>> Error in search function in ListingController >>>>>>>>>>>>>>>>>');
            \Log::info('Message: ' . $e->getMessage());
            \Log::info('Line: ' . $e->getLine());
            \Log::info('Code: ' . $e->getCode());
            \Log::info('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
        }
    }

    public function searchListingsFilter($listings, Request $request) {
        try {
//            if($request->ajax()) {
//                $org = collect($request->json);
//                $result = json_decode($request->json, true);
//                $result = collect($result);

//                $result = Listing::where('status', '=', 2)->with('user.profile', 'featuredImage', 'currency', 'options', 'events')->get();
                $result = $listings;

                $newCollect = new \Illuminate\Support\Collection();
                $flag = false;
                $needed = 0;
                $start = date('Y-m-d', strtotime($request->check_in_date));
                $end = date('Y-m-d', strtotime($request->check_out_date));
                $today = date('Y-m-d');

                if($request->price_min > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['price'] >= $request->price_min;
                    });
                }
                if($request->price_max < 1000 ) {
                    $result = $result->filter(function ($val, $key) use($request) {
                        return $val['price'] <= $request->price_max;
                    });
                }
                if($request->no_of_guest > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['no_of_guest'] >= $request->no_of_guest;
                    });
                }
                if($request->room_type > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['room_type'] >= $request->room_type;
                    });
                }
                if($request->no_of_bedroom > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['no_of_bedroom'] >= $request->no_of_bedroom;
                    });
                }
                if($request->no_of_bath > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['no_of_bath'] >= $request->no_of_bath;
                    });
                }
                if($request->no_of_bed > 0) {
                    $result = $result->filter(function ($val, $key) use ($request) {
                        return $val['no_of_bed'] >= $request->no_of_bed;
                    });
                }
                if($request->properties != '' && $request->properties !== null) {
                    $props = explode(',', $request->properties);
                    $result = $result->filter(function ($val, $key) use ($request, $props) {
                        if(in_array($val['property_type'], $props)) {
                            return $val;
                        }
                    });
                }
                if($request->amenities != '' && $request->amenities !== null) {
                    $amnArr = explode(',', $request->amenities);
                    $result = $result->filter(function ($val, $key) use ($request, $amnArr)  {
                        if(count(array_intersect($amnArr, $val['listing_amenities'])) > 0){
                            return $val;
                        }
                    });
                }
                if($request->check_in_date > $today || $request->check_out_date > $today) {
                    foreach($result as $item) {
                        try {
                            $data = Event::where('listing_id',$item['id'])->whereBetween('start', [$start, $end])->whereBetween('end', [$start, $end])->count();
                            $data2 = Booking::where('listing_id',$item['id'])->where('status', '=', 2)->whereBetween('date_from', [$start, $end])->whereBetween('date_to', [$start, $end])->count();
//                            dump($data);
//                            dump($data2);
                            if($data <= 0 && $data2 <= 0){
                                $newCollect->push($item);
                            }
                        } catch (\Exception $e) {
//                            dd($e);
                        }
                    }
//                    dump($newCollect);
                    if($newCollect->count() > 0) {
                        $result = $newCollect;
                    }
                }
//                dd('=====================================');

                $data = [];
                foreach($result as $listing) {
                    $temp = [];
                    $temp['id'] = $listing['id'];
                    $temp['name'] = $listing['name'];
                    if(isset($listing['featuredImage']) && $listing['featuredImage']['name'] != '') {
                        $temp['photo'] = $listing['featuredImage']['name'];
                    } else {
                        $temp['photo'] = '';
                    }
                    $temp['symbol'] = isset($listing['currency']) && isset($listing['currency']['symbol']) ? $listing['currency']['symbol'] : '';
                    $temp['price'] = (int)$listing['price'];
                    $temp['lat'] = $listing['lat'];
                    $temp['lng'] = $listing['lng'];
                    array_push($data, $temp);
                }
                $mapListings = json_encode($data);
                //return view('partials.searchListings', ['listings' => $result, 'mapListings' => $mapListings]);
                return collect([
                    'status' => 'success',
                    'listings' => $result,
                    'mapListings' => $mapListings
                ]);

//            } else {
//
//            }
        } catch (\Exception $e) {
            return collect([
                'status' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function unpublish($id)
    {
        $model = Listing::where('id',$id)->firstOrFail();
        if($model->user_id == auth()->id()) {
            //$this->AlgoliaSearch->updateStatus($id,1);
            $model->status = 1;
            $model->published_at = null;
            $model->save();
        }
        return redirect()->route('my-listings');
    }

    public function publish($id)
    {
        $model = Listing::where('id',$id)->firstOrFail();
        if($model->user_id == auth()->id()) {
            //$this->AlgoliaSearch->updateStatus($id,2);
            $model->status = 2;
            $model->published_at = Carbon::now()->toDayDateTimeString();
            $model->save();
        }
        return redirect()->route('my-listings');
    }

    public function delete($id)
    {
        $model = Listing::where('id',$id)->firstOrFail();
        if($model->user_id == auth()->id())
        {
//            if(!empty($model->algolia_objectID))
//            {
//                $this->AlgoliaSearch->deleteIndex($model->algolia_objectID);
//            }
            $model->delete();
        }
        return 'success';
    }

    public function mind(Request $request)
    {
        //dd($request);
        $search33 =
            [
                'no_of_guest' => $request->no_of_guest,
                'property_type' => $request->property_type,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'zip_code' => $request->zip_code,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,

            ];

        return redirect('search' )->with(compact('search33'));
    }


    public function createDz(Request $request)
    {

        $this->listing = new Listing();
        $photo = $request->file;
        $name = str_random(5) . '.' . $photo->getClientOriginalName();
        $path = $this->listing->getPath();
        $photo->move($path, $name);

        \Image::make($path . $name)->fit(903, 480)->save($path . 'l_' . $name);
        \Image::make($path . $name)->fit(250, 190)->save($path . 's_' . $name);
        try {
            if (count(\Cache::get('myfiles')) > 0) {
                $myFiles = \Cache::get('myfiles');
                $myFiles->push($name);
                \Cache::store('file')->put('myfiles', $myFiles, 10);
            } else {
                $myFiles = new Collection();
                $myFiles->push($name);
                \Cache::store('file')->put('myfiles', $myFiles, 10);
            }

            return collect([
                'status' => 'success 1',
                'data' => \Cache::get('myfiles')
            ]);
        } catch (\Exception $e) {
            dump($e->getLine());
            dd($e->getMessage());
        }
    }

    public function deleteListingImages($id)
    {
        $listingImage = new ListingImage();
//		dd($listingImage);
        $data = $listingImage->where('id', '=', $id)->delete();
        return collect([
            'status' => 'success',
            'data' => $listingImage
        ]);
    }

    public function removeImages($name)
    {
//		dd($name);
        $obj = \Cache::get('myfiles');
        $newObj = new Collection();
        foreach ($obj as $key => $val) {
            if (strpos($val, $name)) {
                //skip
            } else {
                $newObj->push($val);
            }
        }
        \Cache::store('file')->put('myfiles', $newObj, 10);
        return collect([
            'status' => 'success',
            'data' => \Cache::get('myfiles')
        ]);
    }

    public function getLength(Request $request)
    {
        return collect([
            'status' => 'success',
            'data' => count(\Cache::get('myfiles'))
        ]);
    }

    public function booking()
    {
        $bookings = Booking::with('transaction','guestInfo.profile')->where('host_id',auth()->user()->id)->orwhere('guest_id',auth()->user()->id)->get();
        foreach($bookings as $booking){
            $listing = Listing::with('user.profile', 'listingImage')->findOrFail($booking->listing_id);
            $booking->listingInfo = $listing;
        }
        return view('user.dashboard.bookings')->with('bookings',$bookings);
    }

    public function checkAvailability($id,$start,$end)
    {
        $start = date('Y-m-d', strtotime(str_replace('-', '/', $start)));
        $end = date('Y-m-d', strtotime(str_replace('-', '/', $end)));

        $data = Event::where('listing_id',$id)->whereBetween('start', [$start, $end])->whereBetween('end', [$start, $end])->count();
        $data2 = Booking::where('listing_id',$id)->where('status', '=', 2)->whereBetween('date_from', [$start, $end])->whereBetween('date_to', [$start, $end])->count();


        return collect([
            'status' => 'success',
            'booking' => $data2,
            'event' => $data
        ]);
    }

    public function breakLongText($text, $length = 300, $maxLength = 450){
        try {
            //Text length
            $textLength = strlen($text);
            if($textLength == 0){
                return array();
            }
            //initialize empty array to store split text
            $splitText = array();
            //return without breaking if text is already short
            if (!($textLength > $maxLength)){
                $splitText[] = $text;
                return $splitText;
            }
            //Guess sentence completion
            $needle = '.';
            /*iterate over $text length
              as substr_replace deleting it*/
            while (strlen($text) > $length){
                $end = strpos($text, $needle, $length);
                if ($end === false){
                    //Returns FALSE if the needle (in this case ".") was not found.
                    $splitText[] = substr($text,0);
                    $text = '';
                    break;
                }
                $end++;
                $splitText[] = substr($text,0,$end);
                $text = substr_replace($text,'',0,$end);
            }
            if ($text){
                $splitText[] = substr($text,0);
            }
            return $splitText;
        } catch (\Exception $e) {
            return array();
        }
    }

    public function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }
        return $dates;
    }

    public function congrats($id) {
        if (isset($id) && $id != null) {
            $listing = Listing::with('user', 'featuredImage')->findOrFail($id);
//            dd($listing);
//            dd($listing->showFeaturedImage('m'));
//            dd($listing->user);
            return view('listing.congrats', ['listing' => $listing]);
        }
	}

}
