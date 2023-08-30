<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing= $offer->listing;
        $this->authorize('update', $listing);
        // 接受選擇的出價:
        // 'accepted_at'欄位會顯示當下接受的時間
        $offer->update(['accepted_at'=>now()]);
        // 'sold_at'欄位會顯示當下售出的時間
        $listing->sold_at=now();
        $listing->save();

        // 拒絕其他出價
        $listing->offers()->except($offer)->update(['rejected_at'=>now()]);

        return redirect()->back()
            ->with(
                'success',
                "已接受 #{$offer->id} 號出價，其他出價已拒絕"
            );
    }
}