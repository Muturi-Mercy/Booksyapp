<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
     public function showForm()
    {
        return view('pages.contactus');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'user_id' => Auth::check() ? Auth::id() : null,
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Your message has been sent!');
}
}
