<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use Exception;


class AuthController extends Controller
{

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
                    'exceptions' => true,
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
                'debug' => true,
                'headers' => [
                    'Authorization' => 'Bearer ' . $data['access_token']
                ]
            ]);

            $user = json_decode((string) $response->getBody()->getContents(), true);

            Session::put('user',$user);

        } catch (\Exception $ex) {
            if($ex->getCode()=='401')
                return redirect()->back()->withErrors('Unauthorized')->withInput();
            else {
                Session::forget('access_token');
                session::forget('user');
                Session::flush();
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

    public function index(){
        return view('auth.login');
    }

}
