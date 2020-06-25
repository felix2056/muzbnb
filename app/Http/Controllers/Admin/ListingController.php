<?php

namespace App\Http\Controllers\Admin;

use App\Model\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AlgoliaSearch;

class ListingController extends Controller
{
    /**
     *  Add auth middleware
     *
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
	    $this->AlgoliaSearch  = new AlgoliaSearch();
    }

    /**
     *  shows all Currencies
     *
     * @return void
     */
    public function index()
    {
        $listings = Listing::all();
        return view('admin.listing.index',compact('listings'));
    }
    /**
     *  Listing create form
     *
     * @return void
     */
    public function show($id)
    {
        $listing = Listing::find($id);

        return view('admin.listing.show',compact('listing'));
    }

    /**
     *  Listing create form
     *
     * @return void
     */
    public function create()
    {
        $listing = new Listing();

        return view('admin.listing.create',compact('listing'));
    }

    /**
     *  Stores new Listing
     *
     * @return void
     */
    public function store(Request $request)
    {
        Listing::create($request->except('_token'));
        return redirect('/admin/listing');
    }
    /**
     *  Listing create form
     *
     * @return void
     */
    public function edit($listing)
    {
        $listing = Listing::find($listing);

        return view('admin.listing.edit',compact('listing'));
    }

    /**
     *  Listing create form
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $listing = Listing::find($id);
        $listing->update($request->except('_token'));

        return redirect('/admin/listing');
    }

    public function destroy($id, Request $request)
    {
        if($request->status != ''){
	        //$this->AlgoliaSearch->updateStatus($id,$request->status);
	        $message = ($request->status == 1) ? 'List Un-Published Successfully.':'List Published Successfully.';
            $result = Listing::where('id',$id)->update(['status' => $request->status]);
            session()->flash('success', $message);
        } else {
	        $model = Listing::where('id',$id)->firstOrFail();
	        //$this->AlgoliaSearch->deleteIndex($model->algolia_objectID);
	        $model->delete();
	        session()->flash('success', 'List Deleted Successfully.');
        }
        return response()->json(['status' => 1]);
        //return back();
    }
}
