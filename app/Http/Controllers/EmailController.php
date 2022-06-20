<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use App\Notifications\InvoicePaid;
use App\Notifications\InvoicePaid2;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Auth;

class EmailController extends Controller
{
    // public function index()
    // {
    //     // return view('email_index')->with('pageTitle', 'E-Mail');
    // }

    public function send_email_with_notification1()
    {
        // SEND EMAIL WITH USER MODEL
        $invoice = null;
        // Send to user:
        $user = User::findOrFail(Auth::id());
        $user->notify(new InvoicePaid($invoice));
        return redirect()->route('filmes.list')
            ->with('alert-type', 'success')
            ->with('alert-msg', 'E-Mail sent with success (using Notifications)');
    }

    
}
