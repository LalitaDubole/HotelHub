<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Message sent successfully! We will contact you soon.');
    }

    // Admin - All Contact Messages
    public function adminIndex()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }
}