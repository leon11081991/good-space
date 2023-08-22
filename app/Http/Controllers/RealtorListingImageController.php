<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing){
    
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            [
                'listing'=>$listing
            ]);
    }

    public function store(Listing $listing, Request $result){

        if($result->hasFile('images')){

            $result->validate([
                'images.*'=>'mimes:jpg,png,jpeg|max:50000'
            ],[
                'images.*.mimes'=>'拍謝！這不符合格式，請上傳符合格式的照片喔！'
            ]);

            foreach($result->file('images') as $file){
                
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename'=> $path
                ]));
            }
        }

        return redirect()->back()->with('success', '圖片上傳成功！');
    }

    public function destroy($listing, ListingImage $image){
        // 刪除在 public 的檔案
        Storage::disk('public')->delete($image->filename);

        // 刪除在資料庫上的檔案
        $image->delete();

        return redirect()->back()->with('success', '照片已被刪除囉！');
    }
}
