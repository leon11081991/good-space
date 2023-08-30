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

        // * query addition 添加查詢(優化後)
        // $query->when(
        //     $filters['priceFrom'] ?? false,
        //     // $value 是 第一個參數為true時，第一個參數本身的值
        //     fn($query,$value)=>$query->where('price', '>=',$value)
        // )->when(
        //     $filters['priceTo'] ?? false,
        //     fn($query,$value)=>$query->where('price', '<=',$value)
        // )->when(
        //     $filters['beds'] ?? false,
        //     fn($query,$value)=>$query->where('beds', (int)$value < 6 ? '=' : '>=' ,$value)
        // )->when(
        //     $filters['baths'] ?? false,
        //     fn($query,$value)=>$query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        // )->when(
        //     $filters['areaFrom'] ?? false,
        //     fn($query,$value)=>$query->where('area', '>=',$value)
        // )->when(
        //     $filters['areaTo'] ?? false,
        //     fn($query,$value)=>$query->where('area', '<=',$value)
        // );

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

        $filters = $request->only(
            [
                'priceFrom', 
                'priceTo', 
                'beds', 
                'baths', 
                'areaFrom', 
                'areaTo'
            ]
        );

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // $this->authorize('view',$listing);
        $listing->load(['images']);

        /*
            * 判斷使用者有沒有登入
            * 如果沒有登入那 offer就沒有資料
            * 有登入就 query 該使用者的 offer資料
        */
        $offer = !Auth::user()?null:$listing->offers()->byMe()->first();

        return inertia('Listing/Show',
        [
            'listing'=>$listing,
            'offerMade'=>$offer
        ]
        );
    }

    
}
