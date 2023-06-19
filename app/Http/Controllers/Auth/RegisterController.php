<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'username' => $data['username'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
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
    // }

    protected function create(array $data)
    {
        $ref_source = null;
        $referrer = null;

        if (session()->has('ref_source') && session()->has('referrer')) {
            $ref_source = session('ref_source');
            $referrer = session('referrer');
            session()->forget(['ref_source', 'referrer']);

        } elseif (request()->hasCookie('ref_source') && request()->hasCookie('referrer')) {
            $ref_source = request()->cookie('ref_source');
            $referrer = request()->cookie('referrer');
            cookie()->forget(['ref_source', 'referrer']);
        }

        if (empty($ref_source)) {
            $ref_source = null;
        }

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'ref_source' => $ref_source,
            'referrer' => $referrer,
        ]);

        return $user;
    }

    protected function createFromLink($referrer, $ref_source)
    {
        // Cookie expires in 60 minutes
        cookie()->queue('ref_source', $ref_source, 60);
        cookie()->queue('referrer', $referrer, 60);

        // Save ref_source and referrer in the session
        session(['ref_source' => $ref_source]);
        session(['referrer' => $referrer]);

        return view('auth.register')->with('referrer', $referrer)->with('ref_source', $ref_source);

    }
    protected function FromLink($referrer)
    {
        // Cookie expires in 60 minutes
        cookie()->queue('referrer', $referrer, 60);

        session(['referrer' => $referrer]);

        return view('auth.register')->with('referrer', $referrer);

    }

    protected function saveFromLink(Request $request)

    {
        $this->validator($request->all())->validate();
        
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'ref_source' => $request->ref_source,
            'referrer' => $request->referrer,
        ]);
        return $user;

        Auth::guard()->login($user);
    //    saving directly from the referrer source
        return redirect($this->redirectPath());
    }
}
