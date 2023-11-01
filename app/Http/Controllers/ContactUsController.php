<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
{
    $submissions = ContactUs::all(); // Fetch all contact us form submissions
    return view('contact_us.index', compact('submissions'));
}

public function destroy($id)
{
    $submission = ContactUs::findOrFail($id);
    $submission->delete();

    return redirect()->route('contact_us.index')->with('success', 'Contact form submission deleted successfully');
}
}
