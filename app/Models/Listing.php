<?php

namespace App\Models;

use App\Models\Offer;
use App\Models\ListingImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    // 開啟修改哪些資料庫欄位的權限
    // reference: https://ithelp.ithome.com.tw/articles/10247871
    protected $fillable = [
        'beds', 
        'baths',
        'area', 
        'city', 
        'code', 
        'street', 
        'street_num', 
        'price'
    ];
    protected $sortable = ['price', 'created_at'];

    public function owner(): BelongsTo {
        return $this->belongsTo(\App\Models\User::class, 'by_user_id');
    }

    public function images():HasMany{
        
        return $this->hasMany(ListingImage::class);
    }

    public function scopeMostRecent(Builder $query):Builder{
        return $query->orderByDesc('created_at');
    }

    public function offers():HasMany{
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeWithoutSold(Builder $query):Builder
    {
        // 沒有任何出價，或是，有出價但沒有出價被接受或拒絕的
        // return $query->doesntHave('offers')
        //     ->orWhereHas(
        //         'offers', 
        //         fn(Builder $query)=> 
        //             $query->whereNull('accepted_at')->whereNull('rejected_at')
        //     );

        // 'sold_at'欄位，如果有時間表示已售出，如果null表示未售出
        return $query->whereNull('sold_at');
    }

    public function scopeFilter(Builder $query , array $filters):Builder{

        return $query->when(
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
        )->when(
            $filters['deleted'] ?? false,
            fn($query,$value)=>$query->withTrashed()
        )->when(
            $filters['by'] ?? false,
            fn($query, $value) => 
            // 檢查 'by'是不是在 $sortable裡面
            !in_array($value, $this->sortable) ? $query : 
            $query->orderBy($value, $filters['order'] ?? 'desc')
        );
    }
}
