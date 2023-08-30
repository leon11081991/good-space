<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class NotificationController extends Controller
{
    public function index(Request $request):Response{
        return inertia(
            'Notification/Index',
            [
                'notifications'=> $request
                    ->user() // 只能讀自己的通知
                    ->notifications()
                    ->paginate(10)
            ]
            );
    }
}
