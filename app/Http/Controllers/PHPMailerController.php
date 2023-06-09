<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerController extends Controller
{
    public function composeEmail(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        $mail = new PHPMailer(true);
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:50|min:10',
            'message' => 'required|min:15',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return view('welcome')->with('errors', $validator->errors());
        } else {
            try {

                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server address
                $mail->SMTPAuth = true;
                $mail->Username = 'support@forexbyteemy.com'; // Replace with your SMTP username (email address)
                $mail->Password = 'support2A$'; // Replace with your SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Recipients
                $mail->setFrom($email, $name);
                $mail->addAddress('support@forexbyteemy.com', 'Teemy'); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body = "Name: $name\nEmail: $email\n\n$message";

                $sent = $mail->send();
                if ($sent) {

                    // Create a new instance of the Contact model
                    $contact = new Contact();
                    $contact->name = $name;
                    $contact->email = $email;
                    $contact->message = $message;

                    // Save the contact record to the database
                    $contact->save();
                }

                return view('welcome')->with('message', 'Email sent successfully')->with('success', true);
            } catch (Exception $e) {
                return view('welcome')->with('message', 'Email sending failed: ' . $mail->ErrorInfo)->with('success', false);
            }
        }
    }
}
