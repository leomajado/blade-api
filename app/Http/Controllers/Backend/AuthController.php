<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Traits\UserTrait;

use Illuminate\Http\Request;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Client;

use Exception;

class AuthController extends Controller
{
    use UserTrait;

    public function login(Request $request){
        try {

            $validator = Validator::make($request->all(),[
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()){
                throw new Exception($validator->errors(), 404);
            }

            $api_url = Env::get('API_URL');

            $client = new Client([
                'base_uri' => $api_url,
                'defaults' => [
                    'exceptions' => false,
                    'timeout' => 1000
                ]
            ]);

            $response = $client->post($api_url.'/login',[
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password
                ]
            ]);

            $data = json_decode((string) $response->getBody(), true);
            Session::put('access_token',$data['access_token']);

            $response = $client->get($api_url.'/user',[
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Bearer '.$data['access_token']
                ]
            ]);

            $user = json_decode((string) $response->getBody(), true);

            Session::put('user',$user);

            return view('home',['user' => $user]);

        } catch (\Exception $ex) {
            if($ex->getCode()=='401')
                return redirect()->back()->withErrors('Unauthorized')->withInput();
            else {
                $this->killSession();
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

    public function logout(){
        $this->killSession();
        return redirect('/login');
    }

    public function index(){
        return view('auth.login');
    }

    public function signup(){
        $user = $this->sessionStatus();
        if(!empty($user))
            return view('home',['user' => $user]);
        else
            return view('auth.register');
    }

    public function register(Request $request){
        try {

            $user = $this->sessionStatus();
            if(!empty($user)){
                return view('home',['user' => $user]);
            }

            $validator = Validator::make($request->all(),[
                'name' => 'required | max:255',
                'email' => 'required | max:255',
                'password' => 'required | max:255'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $api_url = Env::get('API_URL');

            $client = new Client([
                'base_uri' => $api_url,
                'defaults' => [
                    'exceptions' => false,
                    'timeout' => 1000
                ]
            ]);

            $response = $client->post($api_url.'/signup',[
                'form_params' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]
            ]);

            $data = json_decode((string) $response->getBody(), true);

            if($data['status']=='ok'){
                return view('auth.login');
            } else {
                throw new Exception("Error Processing Request", 500);
            }

        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }
}
