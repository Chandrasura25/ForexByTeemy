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
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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

        if ($referrer) {
            // Assign 30 credits to the user registering
            $user->credits()->create([
                'amount' => 30,
            ]);

            // Assign 30 credits to the referrer
            $referringUser = User::where('username', $referrer)->first();
            if (!$referringUser) {
                throw new \Exception('Referrer not found.');
            }

            $referringUser->credits()->create([
                'amount' => 30,
            ]);
            // Update the total_credits of the referrer
            $referringUser->update([
                'total_credits' => $referringUser->credits()->sum('amount'),
            ]);
        }
        if ($user) {
            // Update the total_credits in the users table
            $user->update([
                'credits' => $user->credits()->sum('amount'),
            ]);
            try {
                $mail = new PHPMailer(true);

                // Server settings
                $mail->isSMTP();
                $mail->Host = 'mail.forexbyteemy.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'supportm@forexbyteemy.com';
                $mail->Password = 'support@Mail';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('supportm@forexbyteemy.com', 'Teemy');
                $mail->addAddress($user->email);
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Thank you for signing up';

                $body = '
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
                              margin-bottom: 20px;
                            }

                            p {
                              margin-bottom: 10px;
                            }
                          </style>
                        </head>
                        <body>
                          <div class="container">
                            <h1>Thank you for signing up</h1>
                            <p>We appreciate your registration.</p>
                            <p>Feel free to contact us if you have any questions.</p>
                            <p>Best regards,</p>
                            <p>ForexByTeemy</p>
                          </div>
                        </body>
                        </html>';

                $mail->Body = $body;
                $mail->ContentType = "text/html";

                $mail->send();
                return $user;
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Failed to send email');
            }
        }
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
        $referrer = $request->referrer;
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'ref_source' => $request->ref_source,
            'referrer' => $request->referrer,
        ]);
        if ($referrer) {
            // Assign 30 credits to the user registering
            $user->credits()->create([
                'amount' => 30,
            ]);

            // Assign 30 credits to the referrer
            $referringUser = User::where('username', $referrer)->first();
            if (!$referringUser) {
                throw new \Exception('Referrer not found.');
            }

            $referringUser->credits()->create([
                'amount' => 30,
            ]);
            // Update the total_credits of the referrer
            $referringUser->update([
                'total_credits' => $referringUser->credits()->sum('amount'),
            ]);
        }
        if ($user) {
            // Update the total_credits in the users table
            $user->update([
                'credits' => $user->credits()->sum('amount'),
            ]);
            try {
                $mail = new PHPMailer(true);

                // Server settings
                $mail->isSMTP();
                $mail->Host = 'mail.forexbyteemy.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'supportm@forexbyteemy.com';
                $mail->Password = 'support@Mail';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom('supportm@forexbyteemy.com', 'Teemy');
                $mail->addAddress($user->email);
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Thank you for signing up';

                $body = '
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
                      margin-bottom: 20px;
                    }

                    p {
                      margin-bottom: 10px;
                    }
                  </style>
                </head>
                <body>
                  <div class="container">
                    <h1>Thank you for signing up</h1>
                    <p>We appreciate your registration.</p>
                    <p>Feel free to contact us if you have any questions.</p>
                    <p>Best regards,</p>
                    <p>ForexByTeemy</p>
                  </div>
                </body>
                </html>';

                $mail->Body = $body;

                $mail->ContentType = "text/html";
                $mail->send();
                Auth::guard('web')->login($user);

                return redirect($this->redirectPath());
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Failed to send email');
            }
        }

    }
}
