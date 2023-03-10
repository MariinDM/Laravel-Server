<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailerController extends Mailable
{
    public function build()
    {
        return $this->view('token-code');
    }
}
