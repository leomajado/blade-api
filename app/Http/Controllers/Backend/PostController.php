<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Traits\UserTrait;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Session;

use GuzzleHttp\Client;

use Exception;

class PostController extends Controller
{
    use UserTrait;

    public function index(Request $request){
        try {

            $user = $this->sessionStatus();
            if(empty($user)){
                throw new Exception('Unauthorized', 401);
            }

            $api_url = Env::get('API_URL');

            $client = new Client([
                'base_uri' => $api_url,
                'defaults' => [
                    'exceptions' => false,
                    'timeout' => 1000
                ]
            ]);

            $response = $client->get($api_url.'/posts',[
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Bearer '.Session::get('access_token')
                ]
            ]);

            $data = json_decode((string) $response->getBody(),true);

            return view('post', [
                    'user' => $user,
                    'posts' => $data['data']
                ]);

        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }

    public function store(Request $request){
        try {

            if(empty($this->sessionStatus())){
                throw new Exception('Unauthorized', 401);
            }

            $validator = Validator::make($request->all(),[
                'title' => 'required | max:25',
                'description' => 'required | max:255'
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

            $response = $client->post($api_url.'/post',[
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Bearer '.Session::get('access_token')
                ],
                'body' => [
                    'title' => $request->title,
                    'description' => $request->description
                ]
            ]);

            $data = json_decode((string) $response->getBody(),true);

        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    public function delete(Request $request){
        try {
            $data = $request->all();

            $api_url = Env::get('API_URL');

            $client = new Client([
                'base_uri' => $api_url,
                'defaults' => [
                    'exceptions' => false,
                    'timeout' => 1000
                ]
            ]);

            $response = $client->delete($api_url.'/post/'.$data['post'],[
                'debug' => false,
                'headers' => [
                    'Authorization' => 'Bearer '.Session::get('access_token')
                ]
            ]);

            return redirect()->to('posts');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
