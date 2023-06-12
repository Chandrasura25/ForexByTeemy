<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // try {
        //     $mail = new PHPMailer(true);

        //     // Server settings
        //     $mail->isSMTP();
        //     $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server address
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'support@forexbyteemy.com'; // Replace with your SMTP username (email address)
        //     $mail->Password = 'support2A$'; // Replace with your SMTP password
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //     $mail->Port = 465;

        //     // Sender and recipient
        //     $mail->setFrom('support@forexbyteemy.com', 'Teemy'); // Replace with your email and name
        //     $mail->addAddress($user->email); // Send the email to the user's email address

        //     // Email content
        //     $mail->isHTML(false);
        //     $mail->Subject = 'Thank you for signing up';
        //     $mail->Body = 'Thank you for signing up! We appreciate your registration.';

        //     // Send the email
        //     $mail->send();

        //     // Redirect or return a response indicating successful user registration
        //     return redirect()->back()->with('user', $user);
        // } catch (Exception $e) {
        //     // Handle the exception if the email sending fails
        //     // Redirect or return a response indicating the failure
        //     return redirect()->back()->with('error', 'Failed to send email');
        // }
    }
    protected function createFromLink($referrer, $ref_source){
        return view('auth.register')->with('referrer', $referrer)->with('ref_source', $ref_source);
    }
    protected function saveFromLink(Request $request){
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::guard()->login($user);

        return redirect($this->redirectPath());
    }
}
