<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Email;
use App\Models\User;
use DateTime;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function registerView()
    {
        return view('auth/register');
    }
    public function loginView()
    {
        return view('auth/login');
    }

    public function doRegister()
    {
        
        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name field is required'
                ]
            ],
            'email' => [  
               'rules' => 'required|valid_email|is_unique[users.email]',
               'errors' => [
                   'required' => 'Email field is required',
                   'valid_email' => 'Your email must valid',
                   'is_unique' => 'Email already registered'
               ]
            ],
            'password' =>  [
                'rules' => 'required|min_length[5]|max_length[15]',
                'errors' => [
                    'required' => 'Password field is required',
                    'min_length' => 'Password must have min 5 character',
                    'max_length' => 'Password must not have more than 15 character',
                ] 
            ]   
            ]);
        if (!$validation) {
            return view('auth/register', ['validation' => $this->validator]);
        } else {
            $user = new User();

            $query = $user->insert([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT), 
                'created_at' => date('y-m-d H:i:s')
            ]);

            $usrid = $user->getInsertID();
            

            
            $hasFilePhoto = $this->request->getFile('photo');
            if ($hasFilePhoto->getError() !== 4) {
                \Cloudinary::config([
                    "cloud_name" => env('CLOUD_NAME'),
                    "api_key" => env('API_KEY'),
                    "api_secret" => env('API_SECRET'),
                    "secure" => true
                ]);
                
                $img = \Cloudinary\Uploader::upload($this->request->getFile('photo'), ["transformation" => [ "width" => 300 , "height" => 300 ],"folder" => "codeigniter/auth", "public_id" => $usrid]);
                
                $user->update($usrid,[
                    'photo' => $img['secure_url']
                ]);
            }
            
            if (!$query) {
                return redirect()->back()->with('fail', 'Something went wrong');
            }

            return redirect()->to('/login')->with('success', 'Your account registered successfully');
            
        }
    }

    public function doLogin()
    {
        $validation = $this->validate([
            'email' => [  
               'rules' => 'required|valid_email',
               'errors' => [
                   'required' => 'Email field is required',
                   'valid_email' => 'Your email must valid',
               ]
            ],
            'password' =>  [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password field is required',
                ] 
            ]   
            ]);
        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = new User();
            $userInfo = $user->where('email', $email)->first();

            if (!$userInfo) {
                return redirect()->back()->with('fail', 'Email or password does not match with our record');
            } else {
                if (password_verify($password, $userInfo['password'])) {
                    session()->set('user', $userInfo);
                    return redirect()->to('/profile');
                } else {
                    return redirect()->back()->with('fail', 'Email or password does not match with our record');
                }
            }
        }
    }

    public function forgotView()
    {
        return view('auth/forgot');
    }

    public function forgotSubmit()
    {
        $validation = $this->validate([
            'email' => [  
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email field is required',
                    'valid_email' => 'Your email must valid',
                ]
            ]
        ]);
        if(!$validation) {
            return view('auth/forgot', ['validation' => $this->validator]);
        }  else {
        
        $user  = new User();
        $userInfo = $user->where('email', $this->request->getVar('email'))->first();
        if ($userInfo) {
            $rand = base64_encode(random_bytes(32));
            $token = preg_replace('/[^A-Za-z0-9\-]/', '', $rand);
            $userTokenVerify = new Email();
            $userTokenVerify->save([
                'email' => $userInfo['email'],
                'token' => $token,
                'expired' =>  date('y-m-d H:i:s', strtotime("+1 day"))
            ]);
            
            $to = $userInfo['email'];
            $subject = 'Reset Password Link';
            $body     = "<html>"."<body>"."<h3>Hi, ".$userInfo['name']."</h3>"."<p>Your reset password request has been received</p>"."<p>Please click the below link before 1 day, to reset your password.</p>"."<a type='".'button'."' style='background-color: #0039e6; color:white; border: none; border-radius: 8px; padding: 12px 24px; text-align: center; text-decoration: none; display: inline-block; font-size: 11px; font-weight: bold;"."' href='".base_url().'/reset?email='.$to.'&token='.$token."'>CLICK</a>"."<br> <p>@Robxxcraft</p></body></html>";
            $email = \Config\Services::email();
            $email->setFrom('robxxcraft01@gmail.com', 'Robxxcraft');
            $email->setTo($to);
            $email->setSubject($subject);
            $email->setMessage($body);
            $email->send();
            return redirect()->to('/login')->with('sended', 'Check your email for reset password');
            } else {
                return redirect()->back()->with('notFound', 'Email does not match with our record');
            }
        }
    }

    public function resetView()
    {
        return view('auth/reset');
    }

    public function doReset()
    {
        $validation = $this->validate([
            'newPassword' =>  [
                'rules' => 'required|min_length[6]|max_length[15]',
                'errors' => [
                    'required' => 'Password field is required',
                    'min_length' => 'Password must have min 5 character',
                    'max_length' => 'Password must not have more than 15 character',
                ] 
            ]  
        ]);

        if (!$validation) {
            return redirect()->back()->with('validation', $this->validator->getError('newPassword'));
        }

        $userT  = new Email();
        $userToken = $userT->where(['email'=> $this->request->getVar('email'), 'token' => $this->request->getVar('token')])->first();
        if (!isset($userToken)) {
            return redirect()->back()->with('notMatch', 'Token does not match');
        }
        $datenow = new DateTime();
        $expired = new DateTime($userToken['expired']);
        if ($expired > $datenow){
            $user =new User();
            $usr = $user->where('email', $userToken['email'])->first();
            $user->update($usr['id'],['password' => password_hash($this->request->getVar('newPassword'), PASSWORD_BCRYPT)]);
            $userTokn = new Email();
            $userTokn->delete($userToken['id']);
            return redirect()->to('/login')->with('updated', 'Your password changed successfully');
        } else {
            return redirect()->back()->with('token', 'Token Expired');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}