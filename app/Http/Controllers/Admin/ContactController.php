<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    // public function index()
    // {
    //     $messages = ContactMessage::with('user')->latest()->get();
    //     return view('admin.dashboard', compact('messages'));
    // }
}
