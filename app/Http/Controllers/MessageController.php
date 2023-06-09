<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
        public function index()
    {
        $messages = Message::all();
        return view('contact.show', compact('messages'));
    }

        public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('contact.show', compact('message'));
    }
}
