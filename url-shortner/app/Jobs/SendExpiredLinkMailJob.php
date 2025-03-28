<?php

namespace App\Jobs;

use App\Mail\ExpiredLinkMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendExpiredLinkMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $link;
    public $userEmail;

    public function __construct($link, $userEmail)
    {
        $this->link = $link;
        $this->userEmail = $userEmail;
    }

    public function handle()
    {
        Mail::to($this->userEmail)->send(new ExpiredLinkMail($this->link));
    }
}