<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:30',
            'message' => 'required|string|max:1000',
        ]);

        // Send email using the Mailable
        Mail::to('support@ltc.sa')->send(new ContactMail($validated));

        // Optionally return JSON or redirect
        return back()->with('success', 'تم إرسال رسالتك بنجاح! سنقوم بالرد قريبًا.');
    }
}
