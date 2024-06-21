<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MobileChannel;
use App\Models\EmailChannel;

class NotificationController extends Controller
{
    public function index() {
        $mobileChannels = MobileChannel::with([
            'users' => function($query) {
                $query->where('id', Auth::id());
            }
        ])->all();
        $emailChannels = EmailChannel::with([
            'users' => function($query) {
                $query->where('id', Auth::id());
            }
        ])->all();
        // return response
        // ...
    }

    public function update(Request $request) {
        if(count($request['email'])) {
            Auth::user()->emailChannels()->sync($request['emails']);
        } else {
            Auth::user()->emailChannels()->detach();
        }
        if(count($request['mobile'])) {
            Auth::user()->mobileChannels()->sync($request['mobiles']);
        } else {
            Auth::user()->mobileChannels()->detach();
        }
        // return response
        // ...
    }
}
