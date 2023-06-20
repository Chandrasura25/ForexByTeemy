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
                $mail->Host       = 'mail.forexbyteemy.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'supportm@forexbyteemy.com';
                $mail->Password = 'support@Mail'; // Replace with your SMTP password
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom($email, $name);
                $mail->addAddress('supportm@forexbyteemy.com', 'Teemy'); // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <style>
                        body {
                          font-family: Arial, sans-serif;
                          background-color: #f5f5f5;
                          color: #333333;
                          margin: 0;
                          padding: 20px;
                        }
                    
                        .container {
                          max-width: 600px;
                          margin: 0 auto;
                          background-color: #ffffff;
                          padding: 40px;
                          border-radius: 5px;
                          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        }
                    
                        h1 {
                          color: #555555;
                          font-size: 25px;
                          margin-bottom: 20px;
                        }
                    
                        p {
                          margin-bottom: 10px;
                        }
                    
                        .label {
                          font-weight: bold;
                        }
                    
                        .content {
                          margin-top: 10px;
                        }
                      </style>
                    </head>
                    <body>
                      <div class="container">
                        <h1>Contact Information</h1>
                        <p class="label">Name:</p>
                        <p class="content">' . $name . '</p>
                        <p class="label">Email:</p>
                        <p class="content">' . $email . '</p>
                        <p class="label">Message:</p>
                        <p class="content">' . nl2br($message) . '</p>
                      </div>
                    </body>
                    </html>';

                $mail->ContentType = "text/html";

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
