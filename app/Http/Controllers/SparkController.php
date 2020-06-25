<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\emailtemplate;
use App\emaillist;
use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;


class SparkController extends Controller
{
	/**
	 *  Add auth middleware
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin', ['except' => 'logout']);
	}
	/*
	 * Display Assigned templates
	 * */
	public function index(){

		$emaillist = new emaillist();
		$sparkTemplate = $emaillist->getData();
		return view('admin.sparkpost.templates' , compact('sparkTemplate'));
	}

	/*
	 * Assign Template Page show
	 *
	 */
	public function assigntemplate()
	{
		$sparkData = json_decode($this->getCurl())->results;
		$emailname = emaillist::get();
		return view('admin.sparkpost.assign_templates' , compact('emailname' , 'sparkData'));
	}

	/*
	 * Assigning spark Template id To any Default Email
	 * */
	public function save_template(Request $request)
	{
		$emailtemplate = new emailtemplate();
		$emailtemplate->emailslist_id = $request->emailslist_id;
		$emailtemplate->sparktemplate_id = $request->sparktemplate_id;
		$emailtemplate->timestamps = false;
		$emailtemplate->save();
		return redirect()->route('spark_template');
	}

/*
 * Edit Template Page show
 *
 */
	public function edit_template($emailslist_id)
	{
		$sparkData = json_decode($this->getCurl())->results;
		$emailname = emaillist::get();
		$emailTemplate = emailtemplate::where('emailslist_id',$emailslist_id )->first();
		return view('admin.sparkpost.edit_templates' , compact('emailname', 'sparkData', 'emailTemplate'));
	}

	/*
		 * Assigning spark Template id To any Default Email
		 * */
	public function update_template(Request $request)
	{
		$emailtemplate = new emailtemplate();
		$emailtemplate->where('emailslist_id', '=', $request->old_emailid)->delete();
		$emailtemplate->emailslist_id = $request->emailslist_id;
		$emailtemplate->sparktemplate_id = $request->sparktemplate_id;
		$emailtemplate->timestamps = false;
		$emailtemplate->save();
		return redirect()->route('spark_template');
	}




	/*
	 * Curl Request get data
	 * */
	public function getCurl(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sparkpost.com/api/v1/templates/",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: 55d92516c296b3fbd41550d21dc7877d64a18a10",
				"cache-control: no-cache",
				"postman-token: 3518a353-a05f-3947-d1d1-3d1dd535d172"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		return $response;

	}



	public function getSparkTemplateId($emailname ,$useremail, $name=false , $link=false, $viewlistinglink=false,$managelistinglink=false, $comment = false)
	{

		$emaillist = new emaillist();
		$emailid    = $emaillist->select('id')->where('unique_name' ,$emailname)->first();

		$emailtemplate = new emailtemplate();
		$templateId     = $emailtemplate->select('sparktemplate_id')->where('emailslist_id' ,$emailid->id)->first();
		$sparkfrom = json_decode($this->getSingleTemplateCurl($templateId->sparktemplate_id))->results->content->from->email;
		$sparksubject = json_decode($this->getSingleTemplateCurl($templateId->sparktemplate_id))->results->content->subject;
		$sparkHtml = json_decode($this->getSingleTemplateCurl($templateId->sparktemplate_id))->results->content->html;

		if(!empty($name)){ $sparkHtml = str_replace("{{user_name}}",$name,$sparkHtml); }
		if(!empty($link)){$sparkHtml = str_replace("{{link}}",$link,$sparkHtml);}
		if(!empty($viewlistinglink)){$sparkHtml = str_replace("{{viewlisting}}",$viewlistinglink,$sparkHtml);}
		if(!empty($managelistinglink)){$sparkHtml = str_replace("{{managelisting}}",$managelistinglink,$sparkHtml);}
//		if(!empty($comment)){$sparkHtml = str_replace("{{comment}}",$comment,$sparkHtml);}



		$httpClient = new GuzzleAdapter(new Client());
		//$sparky = new SparkPost($httpClient, ['key' => env('SPARKPOST_KEY')]);
		$sparky = new SparkPost($httpClient, ['key' => '55d92516c296b3fbd41550d21dc7877d64a18a10']);
		$sparky->setOptions(['async' => false]);
		$sparky->setOptions(['sandbox' => true]);

	    $results = $sparky->transmissions->post([
	    	'content' => [
			    'name' => 'MuzBnb',
	    		'from' => ' MuzBnb '.'<'. $sparkfrom .'>',
			    'subject' => $sparksubject,
			    'html' => $sparkHtml
		    ],
		    'recipients' => [
		    	['address' => ['email' => $useremail]]
		                    ]
	    ]);
		return $results->getBody();
	}

	/*
	* Curl Request get data
	*/
	public function getSingleTemplateCurl($sparktemplate_id){

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.sparkpost.com/api/v1/templates/".$sparktemplate_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: 55d92516c296b3fbd41550d21dc7877d64a18a10",
				"cache-control: no-cache",
				"postman-token: 3518a353-a05f-3947-d1d1-3d1dd535d172"
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

}
