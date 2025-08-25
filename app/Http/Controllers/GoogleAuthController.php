<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json')); // your client_secret.json
        $client->addScope([
            \Google\Service\Calendar::CALENDAR_READONLY,
            \Google\Service\Gmail::GMAIL_READONLY,
            \Google\Service\Tasks::TASKS_READONLY,
        ]);
        $client->setRedirectUri(route('google-auth-callback'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $authUrl = $client->createAuthUrl();

        return redirect($authUrl);
    }

    public function callbackGoogle(Request $request)
    {
        if (!$request->has('code')) {
            return redirect()->route('dashboard')->with('error', 'Authorization failed.');
        }

        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->setRedirectUri(route('google-auth-callback'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        if (isset($token['error'])) {
            return redirect()->route('dashboard')->with('error', 'Failed to get access token.');
        }

        // Save token.json to storage
        $tokenPath = storage_path('app/google/token.json');
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($token));

        return redirect()->route('dashboard')->with('success', 'Google account linked successfully!');
    }
}
