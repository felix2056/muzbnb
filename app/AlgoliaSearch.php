<?php

namespace App;

use Doctrine\DBAL\Events;
use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use App\Model\Listing;
use App\Model\ListingImage;
use App\User;
use App\Model\UserProfile;
use App\Model\Currency;
use App\Model\ListingOption;
use Illuminate\Http\Response;
use App\Model\Event;
use App;

class AlgoliaSearch extends Model
{




	public function __construct()
	{
		$client = new \AlgoliaSearch\Client("N5E0GDG3YF", "1d1c0847645e66babbc90231df4e73bf");
		$environment = App::environment();
		if(App::environment() == 'production'|| App::environment() == 'stage'){
			$this->index = $client->initIndex( 'Production_Muzbnb' );
			$this->saveSetting();
		} else {
			$this->index = $client->initIndex('Development_Muzbnb');
           // $this->saveSetting();
		}

		$this->Listing = new Listing();
		$this->ListingImage = new ListingImage();
		$this->User = new User();
		$this->UserProfile = new UserProfile();
		$this->Currency = new Currency();
		$this->Events   = new Event();
	}

	/*
	 * Save Indexes in algolia
	 * */
	public function saveIndex($listing_id ,$amenities)
	{

		$Events = $this->Events->where('listing_id' , $listing_id)->get();
		$checkincheckout= [];
			foreach ($Events as $key => $Event)
			{
				$checkincheckout[strtotime($Event->start)] = strtotime($Event->start);
			}
		$notavailabledates = (object)$checkincheckout;

		$amenityAlgolia= [];
		if(is_array($amenities) && !empty($amenities)) {
			foreach ($amenities as $key => $amenity)
			{
				$amenityAlgolia[$amenity] = $amenity;
			}
		}
		$amenityAlgolia = (object) $amenityAlgolia;
		$Listing  = $this->Listing->find($listing_id);

		$listingPhoto = $this->ListingImage->where('listing_id' , $Listing->id)->first();
		if(isset($listingPhoto)&&isset($listingPhoto->name)) {
			$photo   = asset( 'images/listings/m_' . $listingPhoto->name );
			$records = [
				'id'                    => $Listing->id,
				'name'                  => $Listing->name,
				'description'           => $Listing->description,
				'property_type'         => $Listing->property_type,
				'room_type'             => $Listing->room_type,
				'no_of_guest'           => $Listing->no_of_guest,
				'no_of_bedroom'         => $Listing->no_of_bedroom,
				'no_of_bed'             => $Listing->no_of_bed,
				'no_of_king_bed'        => $Listing->no_of_king_bed,
				'no_of_queen_bed'       => $Listing->no_of_queen_bed,
				'no_of_full_bed'        => $Listing->no_of_full_bed,
				'no_of_twin_bed'        => $Listing->no_of_twin_bed,
				'no_of_couch_bed'       => $Listing->no_of_couch_bed,
				'no_of_airbed'          => $Listing->no_of_airbed,
				'no_of_bath'            => $Listing->no_of_bath,
				'country'               => $Listing->country,
				'address1'              => $Listing->address1,
				'address2'              => $Listing->address2,
				'city'                  => $Listing->city,
				'state'                 => $Listing->state,
				'zip_code'              => $Listing->zip_code,
				'symbol'                => $this->Currency->find( $Listing->currency_id )->symbol,
				'price'                 => (int) $Listing->price,
				'cancellation_type'     => $this->Listing->cancellationOptions( $Listing->cancellation_type ),
				'minimum_night'         => $Listing->minimum_night,
				'maximum_night'         => $Listing->maximum_night,
				'check_in_time'         => $Listing->check_in_time,
				'check_out_time'        => $Listing->check_out_time,
				'advanced_booking_time' => $Listing->advanced_booking_time,
				'currency_id'           => $Listing->currency_id,
				'user_id'               => $Listing->user_id,
				'deleted_at'            => $Listing->deleted_at,
				'created_at'            => $Listing->created_at,
				'updated_at'            => $Listing->updated_at,
				'status'                => $Listing->status,
				'email_verified'        => $Listing->email_verified,
				'phone_verified'        => $Listing->phone_verified,
				'address_verified'      => $Listing->address_verified,
				'lat'                   => $Listing->lat,
				'lng'                   => $Listing->lng,
				'published_at'          => $Listing->published_at,
				'photo'                 => $photo,
				'noOfHostReview'        => '0',
				'url'                   => route( 'room', $Listing->id ),
				'property_type_display' => $this->Listing->propertyOptions( $Listing->property_type ),
				'room_type_display'     => $this->Listing->roomTypeOptions( $Listing->room_type ),
				'amenities'             => $amenityAlgolia,
				'notavailabledates'     => $notavailabledates
			];
			$result  = $this->index->addObjects( [ $records ] );

			return $result['objectIDs'][0];
		}
		else return '404';
	}

	/*
	 * Update Indexes on object ID
	 * */
	public function updateIndex($listing_id , $amenities)
	{
		$Listing  = $this->Listing->find($listing_id);
		$Events = $this->Events->where('listing_id' , $listing_id)->get();
		$checkincheckout= [];
		foreach ($Events as $key => $Event)
		{
			$checkincheckout[strtotime($Event->start)] = strtotime($Event->start);
		}
		$notavailabledates = (object)$checkincheckout;

		$amenityAlgolia= [];
		if(is_array($amenities) && !empty($amenities)) {
			foreach ($amenities as $key => $amenity)
			{
				$amenityAlgolia[$amenity] = $amenity;
			}
		}
		$amenityAlgolia = (object) $amenityAlgolia;
		$Listing  = $this->Listing->find($listing_id);
		$listingPhoto = $this->ListingImage->where('listing_id' , $Listing->id)->first();
		if(isset($listingPhoto)&&isset($listingPhoto->name))
		{
		$photo = asset('images/listings/m_'.$listingPhoto->name);
		$records = [
			'id'                    =>  $Listing->id,
			'name'                  =>  $Listing->name,
			'description'           =>  $Listing->description,
			'property_type'         =>  $Listing->property_type,
			'room_type'             =>  $Listing->room_type,
			'no_of_guest'           =>  $Listing->no_of_guest,
			'no_of_bedroom'         =>  $Listing->no_of_bedroom,
			'no_of_bed'             =>  $Listing->no_of_bed,
			'no_of_king_bed'        =>  $Listing->no_of_king_bed,
			'no_of_queen_bed'       =>  $Listing->no_of_queen_bed,
			'no_of_full_bed'        =>  $Listing->no_of_full_bed,
			'no_of_twin_bed'        =>  $Listing->no_of_twin_bed,
			'no_of_couch_bed'       =>  $Listing->no_of_couch_bed,
			'no_of_airbed'          =>  $Listing->no_of_airbed,
			'no_of_bath'            =>  $Listing->no_of_bath,
			'country'               =>  $Listing->country,
			'address1'              =>  $Listing->address1,
			'address2'              =>  $Listing->address2,
			'city'                  =>  $Listing->city,
			'state'                 =>  $Listing->state,
			'zip_code'              =>  $Listing->zip_code,
			'symbol'                =>  $this->Currency->find($Listing->currency_id)->symbol,
			'price'                 =>  (int)$Listing->price,
			'cancellation_type'     =>  $this->Listing->cancellationOptions($Listing->cancellation_type),
			'minimum_night'         =>  $Listing->minimum_night,
			'maximum_night'         =>  $Listing->maximum_night,
			'check_in_time'         =>  $Listing->check_in_time,
			'check_out_time'        =>  $Listing->check_out_time,
			'advanced_booking_time' =>  $Listing->advanced_booking_time,
			'currency_id'           =>  $Listing->currency_id,
			'user_id'               =>  $Listing->user_id,
			'deleted_at'            =>  $Listing->deleted_at,
			'created_at'            =>  $Listing->created_at,
			'updated_at'            =>  $Listing->updated_at,
			'status'                =>  $Listing->status,
			'email_verified'        =>  $Listing->email_verified,
			'phone_verified'        =>  $Listing->phone_verified,
			'address_verified'      =>  $Listing->address_verified,
			'lat'                   =>  $Listing->lat,
			'lng'                   =>  $Listing->lng,
			'published_at'          =>  $Listing->published_at,
			'photo'                 =>  $photo,
			'noOfHostReview'        =>  '0',
			'url'                   =>  route('room', $Listing->id),
			'property_type_display' =>  $this->Listing->propertyOptions($Listing->property_type),
			'room_type_display'     =>  $this->Listing->roomTypeOptions($Listing->room_type),
			'amenities'             => $amenityAlgolia,
			'notavailabledates'     => $notavailabledates,
			'objectID'              => $Listing->algolia_objectID
			];
		$result = $this->index->partialUpdateObject($records);

		}
	}


	/**/
	public function updateStatus($listing_id , $status)
	{
		$Listing  = $this->Listing->find($listing_id);
		$records = [
			'status'                =>  $status,
			'objectID'              => $Listing->algolia_objectID
		];
		$result = $this->index->partialUpdateObject($records);
	}
	/**/


	/*
	 * Delete Indexes on behalf Object ID
	 * */
	public function deleteIndex($algolia_objectID)
	{
		$this->index->deleteObject($algolia_objectID);
	}



	/*
	 * Update Setting to algolia Search
	 * */
	public function saveSetting()
	{
		$this->index->setSettings([
			'typoTolerance' => true
		]);
		$setSetting  = $this->index->setSettings([
			'attributesForFaceting' => [
				"id","name",
				"description",
				"property_type",
				"room_type",
				"no_of_guest",
				"no_of_bedroom",
				"no_of_bed",
				"no_of_king_bed",
				"no_of_full_bed",
				"no_of_twin_bed",
				"no_of_couch_bed",
				"no_of_airbed",
				"no_of_bath",
				"country",
				"address1",
				"address2",
				"city",
				"state",
				"zip_code",
				"symbol",
				"price",
				"cancellation_type",
				"minimum_night",
				"maximum_night",
				"check_in_time",
				"check_out_time",
				"advanced_booking_time",
				"currency_id",
				"user_id",
				"status",
				"lat",
				"lng",
				"hostName",
				"amenities",
				"notavailabledates"
			]
		]);
		$setSetting = $this->index->setSettings([
			'searchableAttributes' => [
				"id,name",
				"description",
				"property_type",
				"room_type",
				"no_of_guest",
				"no_of_bedroom",
				"no_of_bed",
				"no_of_king_bed",
				"no_of_full_bed",
				"no_of_twin_bed",
				"no_of_couch_bed",
				"no_of_airbed",
				"no_of_bath",
				"country",
				"address1",
				"address2",
				"city",
				"state",
				"zip_code",
				"symbol",
				"price",
				"cancellation_type",
				"minimum_night",
				"maximum_night",
				"check_in_time",
				"check_out_time",
				"advanced_booking_time",
				"currency_id",
				"user_id",
				"status",
				"lat",
				"lng",
				"hostName",
				"amenities",
				"notavailabledates"

			]
		]);
		$this->index->setSettings([
			'attributeForDistinct' => 'name'
		]);
		$result = $this->index->setSettings([
			'ranking' => [
				"asc(price)"
			]
		]);

		$numericSetting = $this->index->setSettings([
			'numericAttributesForFiltering' => [
				'price',
				'no_of_guest',
				'no_of_bedroom',
				'property_type',
			]
		]);
		$attributesToRetrieve =$this->index->setSettings([
			'attributesToRetrieve' => [
				"*"
			]
		]);
	}
}
