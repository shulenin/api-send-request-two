<?php

namespace App\Orchid\Services;

use App\Mail\SendAnswerMail;
use App\Models\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Orchid\Support\Facades\Toast;

class SendAnswerService
{
    public function handle(array $data)
    {
        /** @var Request $request */
        $request = Request::query()
            ->where('id', '=', $data['request']['id'])
            ->first();

        $request->answer = $data['answer'];
        $request->status = Request::ANSWERED_STATUS;

        $mail = new SendAnswerMail($request->title, $data['answer']);

        $this->send($data['user']['email'], $mail);

        if (! $request->save()) {
            Toast::error('Answer not been saved');
        }

        Toast::success('Answer is sent');
    }

    public function send(string $email, Mailable $mail)
    {
        try {
            Mail::to($email)->send($mail);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            Toast::error('Mail not be sent');
        }
    }
}
