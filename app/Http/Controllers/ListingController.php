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
        $filters = $request->only(['priceFrom','priceTo','beds','baths','areaFrom','areaTo']);
        $query = Listing::mostRecent();

        // * query addition 添加查詢(優化後)
        $query->when(
            $filters['priceFrom'] ?? false,
            // $value 是 第一個參數為true時，第一個參數本身的值
            fn($query,$value)=>$query->where('price', '>=',$value)
        )->when(
            $filters['priceTo'] ?? false,
            fn($query,$value)=>$query->where('price', '<=',$value)
        )->when(
            $filters['beds'] ?? false,
            fn($query,$value)=>$query->where('beds', (int)$value < 6 ? '=' : '>=' ,$value)
        )->when(
            $filters['baths'] ?? false,
            fn($query,$value)=>$query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false,
            fn($query,$value)=>$query->where('area', '>=',$value)
        )->when(
            $filters['areaTo'] ?? false,
            fn($query,$value)=>$query->where('area', '<=',$value)
        );

        // * query addition 添加查詢(優化前)
        // if($filters['priceFrom'] ?? false){
        //     // 如果'priceFrom'有被定義
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        // if($filters['priceTo'] ?? false){
        //     // 如果'priceTo'有被定義
        //     $query->where('price', '<=', $filters['priceTo']);
        // }

        // if($filters['beds'] ?? false){
        //     // 如果'beds'有被定義
        //     $query->where('beds', $filters['beds']);
        // }

        // if($filters['baths'] ?? false){
        //     // 如果'baths'有被定義
        //     $query->where('baths', $filters['baths']);
        // }

        // if($filters['areaFrom'] ?? false){
        //     // 如果'areaFrom'有被定義
        //     $query->where('area', '>=', $filters['areaFrom']);
        // }

        // if($filters['areaTo'] ?? false){
        //     // 如果'areaTo'有被定義
        //     $query->where('area', '<=', $filters['areaTo']);
        // }

        return inertia(
            'Listing/Index',
            [
                'filters'=> $filters,
                'listings' => $query->paginate(10)->withQueryString()
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
