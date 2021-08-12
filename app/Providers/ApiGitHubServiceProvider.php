<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use App\Validators\ApiSearchValidator;

class ApiGitHubServiceProvider extends ServiceProvider
{
    public static function search($method, $request)
    {
        $validator = new ApiSearchValidator;
        $validator = $validator->inputValidate($request->all(), $method);
        if ($validator->fails()){
            return response()->json([
                'message' => 'Nieprawidłowy format danych',
                'errors' => $validator->errors()
            ]);
        }
        $query = ApiGitHubServiceProvider::getQuery($request);
        $url = env('API_GITHUB_URL').'search/'.$method.'?'.$query;
        switch($method){
            case 'commits': $accept = 'application/vnd.github.cloak-preview'; break;
            case 'topics': $accept = 'application/vnd.github.mercy-preview+json'; break;
            default: $accept = 'application/vnd.github.v3+json'; break;
        }
        $response = Http::accept($accept)->get($url);

        if ($response->failed()){
            return response()->json([
                'status' => $response->status(),
                'message' => 'Błąd zapytania',
                'errors' => $response->json()
            ]);
        } else {
            return response()->json([
                'status' => $response->status(),
                'message' => 'Wyniki wyszukiwania',
                'response' => $response->json()
            ]);
        }
    }

    private static function getQuery($request)
    {
        $query = 'q=';
        $params = '';
        foreach($request->all() as $key => $value){
            if ($key == 'search') $query .= $value;
            else if ($key == 'order') $params .= '&sort=indexed&order='.$value;
            else if ($key == 'per_page') $params .= '&per_page='.$value;
            else if ($key == 'page') $params .= '&page='.$value;
            else $query .= ' '.$key.':'.$value;
        }
        $query .= $params;
        
        return $query;
    }

}
