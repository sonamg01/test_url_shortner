<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use App\jobs\SendExpiredLinkMailJob;

class LinkController extends Controller
{
    public function checkExpirdLinks()
    {
        $expiredLinks = ShortLink::where('expires_at', '<', now())->where('status', 0)->get();
        foreach($expiredLinks as $link){
            dispatch(new SendExpiredLinkMailJob($link, $link->user->email));

            $link->status = 1;
            $link->save();

        }

        return "Expired Link Processed";
    }
}
