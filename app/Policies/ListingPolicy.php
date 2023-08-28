<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    use HandlesAuthorization;

    public function before(?User $user, $ability){
        
        if($user && $user->is_admin){
            return true;
        }
        // * 等同上面程式碼
        // if($user?->is_admin){
        //     return true;
        // }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): bool
    {
        // 所有人都可以訪問
        // return true;

        // 使用者登入後可以看到自己建立的列表
        if($listing->by_user_id === $user?->id){
            return true;
        }

        // 只能看到未售出的列表
        return $listing->sold_at === null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): bool
    {
        return $user->id=== $listing->by_user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): bool
    {
        return $user->id=== $listing->by_user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        return $user->id=== $listing->by_user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id=== $listing->by_user_id;
    }
}
