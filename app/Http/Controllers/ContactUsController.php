<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\AdminMail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function showContactForm()
    {
        return view('contact');
    }
    public function submitContactForm(ContactUsRequest $request)
    {

        $request->validated();

        // Send the email
        Mail::to($request->email)->send(new ContactMail($request->name, $request->email, $request->content));
        Mail::to('admin@admin.com')->send(new AdminMail($request->name, $request->email, $request->content));



        return redirect()->route('contact.show')->with('success', 'Thank you for contacting us!');
    }
}
