<?php

namespace App\Http\Controllers\Admin;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function postJudgeNotification(Request $request){
        $data = $request->validate([
            'jid'=>'required',
            'message'=>'required',
        ]);
        $new= Notifications::create(
            [
                'uid' => $data['jid'],
                'message' => $data['message'],
            ]);
        return $new;
    }
}