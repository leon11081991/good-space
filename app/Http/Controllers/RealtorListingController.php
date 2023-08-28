<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct(){
        
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request){

        //dd(Auth::user()->listings);
        //dd($request->all());
        // dd($request->boolean('deleted'));
        $filters = [
            'deleted'=> $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];

        return inertia('Realtor/Index', 
        [   'filters'=>$filters,
            'listings'=> Auth::user()
            ->listings()
            ->filter($filters)
            ->withCount('images')
            ->withCount('offers')
            ->paginate(5)
            ->withQueryString()
        ]);
        
    }

    public function show(Listing $listing){
    
        return inertia(
            'Realtor/Show',
            [
                'listing'=>$listing->load('offers', 'offers.bidder')
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        
        // $this->authorize('create', Listing::class);

        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // * 顯示資料在前台
        //dd($request->all());

        // * 將表單的資料創建一個資料庫列表(會直接創建 without validation)
        //Listing::create($request->all());

        
        $request->user()->listings()->create(
            $request->validate(
                [
                    'beds'=>'required|integer|min:0|max:20',
                    'baths'=>'required|integer|min:0|max:20',
                    'area'=>'required|decimal:0,4|min:5|max:1500',
                    'city'=>'required',
                    'code'=>'required',
                    'street'=>'required',
                    'street_num'=>'nullable',
                    'price'=>'required'
                ]
            )
        );

        return redirect()->route('realtor.listing.index')->with('success','房屋資訊已建立!');
    }

    public function edit(Listing $listing){
        return inertia('Realtor/Edit',['listing'=>$listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing){
        $listing->update(
            $request->validate(
                [
                    'beds'=>'required|integer|min:0|max:20',
                    'baths'=>'required|integer|min:0|max:20',
                    'area'=>'required|integer|min:15|max:1500',
                    'city'=>'required',
                    'code'=>'required',
                    'street'=>'required',
                    'street_num'=>'nullable',
                    'price'=>'required'
                ]
            )
        );

        return redirect()->route('realtor.listing.index')->with('success','房屋資訊已修改!');
    }

    public function destroy(Listing $listing){
        // soft delete
        $listing->delete();

        return redirect()->back()->with('success', '房屋資訊已被修改!');
    }

    public function restore(Listing $listing){
    
        $listing->restore();

        return redirect()->back()->with('success', '房屋資訊已復原!');
    }
}
