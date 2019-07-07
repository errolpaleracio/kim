<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://leader.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => 'zqQy12b2GmdSJmBI4VhPpkYtkhksXMuPnBVGDbMh',
                'username' => $request->username,
                'password' => $request->password
            ]
        ]);
            
        return json_decode((string) $response->getBody(), true);
        
    }
}
