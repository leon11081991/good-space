<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia(
            'Listing/Index',
            [
                'filters'=> $request->only(['priceFrom','priceTo','beds','baths','areaFrom','areaTo']),
                'listings' => Listing::orderByDesc('created_at')
                ->paginate(10)
                ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // * 顯示資料在前台
        //dd($request->all());

        // * 將表單的資料創建一個資料庫列表(會直接創建 without validation)
        //Listing::create($request->all());

        
        $request->user()->listings()->create(
            $request->validate(
                [
                    'beds'=>'required|integer|min:0|max:20',
                    'baths'=>'required|integer|min:0|max:20',
                    'area'=>'required|integer|min:15|max:1500',
                    'city'=>'required',
                    'code'=>'required',
                    'street'=>'required',
                    'street_num'=>'required|integer|max:1000',
                    'price'=>'required'
                ]
            )
        );

        return redirect()->route('listing.index')->with('success','Listing was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // $this->authorize('view',$listing);

        return inertia('Listing/Show',['listing'=>$listing]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Listing/Edit',['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate(
                [
                    'beds'=>'required|integer|min:0|max:20',
                    'baths'=>'required|integer|min:0|max:20',
                    'area'=>'required|integer|min:15|max:1500',
                    'city'=>'required',
                    'code'=>'required',
                    'street'=>'required',
                    'street_num'=>'required|integer|max:1000',
                    'price'=>'required'
                ]
            )
        );

        return redirect()->route('listing.index')->with('success','Listing was changed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Listing is deleted!');
    }
}