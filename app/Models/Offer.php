<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    // 開啟修改哪些資料庫欄位的權限
    protected $fillable= [
        'amount', 
        'accepted_at', 
        'rejected_at'
    ];

    // 每一筆出價都屬於一個房屋清單
    public function listing():BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    // 每一筆出價都有一個出價者
    public function bidder():BelongsTo
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('bidder_id', Auth::user()?->id);
    }

    public function scopeExcept(Builder $query, Offer $offer): Builder
    {
        return $query->where('id', '!=', $offer->id);
    }
}
