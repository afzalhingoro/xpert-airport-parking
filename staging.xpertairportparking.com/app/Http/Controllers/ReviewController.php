<?php

namespace App\Http\Controllers;

use App\Models\reviews;
use Illuminate\Http\Request;
use PhpMimeMailParser\Parser;
class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
         
        $request->validate([
            'rating' => 'required',
           // 'username' => 'required',
            //'email' => 'required|email',
            //'company_id' => 'required',

        ]);
        $review = new reviews();
       
        $review->review = $request->review_content;
        $review->rating = $request->rating;
        $review->username = $request->username;
        $review->email = $request->email;
        $review->company_id = $request->company_id;
        $review->save();
        return redirect()->back()->with('success', $request->review_content)->with('rating', $request->rating);
    }


    public function readEmails()
    {
        $emailFolderPath =  asset('aris').'/path/to/your/email/folder';

        // Get a list of email files in the folder
        $emailFiles = glob($emailFolderPath . '/*.eml');

        foreach ($emailFiles as $emailFile) {
            // Create a new instance of the parser
            $parser = new Parser();
            $parser->setPath($emailFile);

            // Parse the email
            $subject = $parser->getHeader('subject');
            $from = $parser->getHeader('from');
            $body = $parser->getMessageBody('text');

            // Process the email (e.g., search for keywords)
            // ...

            // Display email information
            echo 'Subject: ' . $subject . '<br>';
            echo 'From: ' . $from . '<br>';
            echo 'Body: ' . $body . '<br>';
        }

        return "Emails processed successfully.";
    }
}
