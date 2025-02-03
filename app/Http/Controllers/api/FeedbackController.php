<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Feedback;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function feedback(Request $request)
    {
        try {
            $request->validate([
                'rating' => 'required',
            ]);
            $feedback = new Feedback();
            $feedback->user_id = Auth::user()->id;
            $feedback->rating = $request->rating;
            $feedback->title = $request->title;
            $feedback->description = $request->description;
            $feedback->save();
            return Util::getSuccessMessage('Feedback Added Successfully', $feedback);
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }
    public function contact(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|min:10 | max:10',
                'subject' => 'required',
                'message' => 'required',
            ]);
            $contact = new Contact();
            $contact->name = $request->first_name . ' ' . $request->last_name;
            $contact->email = $request->email;
            $contact->mobile = $request->mobile;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            return Util::getSuccessMessage('Contact Added Successfully', $contact);
        } catch (\Exception $e) {
            return Util::getErrorMessage($e->getMessage());
        }
    }
}
