<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('frontend.contact', compact('contacts'));
    }

    public function contact_store(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->with('success', 'Your message has been sent successfully');
    }

    public function contact(){

        $contacts = Contact::orderBy('created_at','DESC')->paginate(10);
        return view('admin.home.contact', compact('contacts'));
    }


}
