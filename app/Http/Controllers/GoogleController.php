<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Gmail;
use Google\Service\Tasks;

class GoogleController extends Controller
{
    protected function getGoogleClient()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json')); // place your client_secret.json here
        $client->addScope([
            Calendar::CALENDAR_READONLY,
            Gmail::GMAIL_READONLY,
            Tasks::TASKS_READONLY,
        ]);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Get stored token
        $tokenPath = storage_path('app/google/token.json');
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        // Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                file_put_contents($tokenPath, json_encode($client->getAccessToken()));
            } else {
                // Redirect user to Google OAuth flow
                return redirect()->route('google-auth');
            }
        }

        return $client;
    }

    public function calendar()
    {
        $client = $this->getGoogleClient();
        if ($client instanceof \Illuminate\Http\RedirectResponse) return $client;

        $service = new Calendar($client);
        $events = $service->events->listEvents('primary', [
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        ]);

        $data = [];
        foreach ($events->getItems() as $event) {
            $start = $event->start->dateTime ?? $event->start->date;
            $end = $event->end->dateTime ?? $event->end->date;

            $data[] = [
                'summary' => $event->getSummary(),
                'start'   => $start,
                'end'     => $end,
            ];
        }

        return view('google.calendar', ['events' => $data]); 
    }

    public function emails()
    {
        $client = $this->getGoogleClient();
        if ($client instanceof \Illuminate\Http\RedirectResponse) return $client;

        $service = new Gmail($client);
        $messages = $service->users_messages->listUsersMessages('me', ['maxResults' => 10]);

        $data = [];
        foreach ($messages->getMessages() as $msg) {
            $message = $service->users_messages->get('me', $msg->getId());
            $headers = $message->getPayload()->getHeaders();

            $from = $subject = $date = '';

            foreach ($headers as $header) {
                if ($header->name == 'From') $from = $header->value;
                if ($header->name == 'Subject') $subject = $header->value;
                if ($header->name == 'Date') $date = $header->value;
            }

            $data[] = [
                'from' => $from,
                'subject' => $subject,
                'date' => $date,
            ];
        }

        return view('google.emails', ['emails' => $data]);
    }

    public function todos()
    {
        $client = $this->getGoogleClient();
        if ($client instanceof \Illuminate\Http\RedirectResponse) return $client;

        $service = new Tasks($client);
        $tasks = $service->tasks->listTasks('@default', ['maxResults' => 10]);

        $data = [];
        foreach ($tasks->getItems() as $task) {
            $data[] = [
                'title'  => $task->getTitle(),
                'status' => $task->getStatus(),
                'due'    => $task->getDue(),
            ];
        }

        return view('google.todos', ['todos' => $data]);
    }
}
