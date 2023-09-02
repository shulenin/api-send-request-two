<?php

namespace App\Orchid\Screens\Request;

use App\Models\Request;
use App\Orchid\Services\SendAnswerService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class ViewPendingRequestList extends Screen
{
    public function __construct(private SendAnswerService $sendAnswerService) {}

    public function query(Request $request): iterable
    {
        return [
            'request' => $request,
            'user' => $request->user,
        ];
    }

    public function name(): ?string
    {
        return 'View Request';
    }

    public function layout(): iterable
    {
        return [
            Layout::legend('user', [
                Sight::make('name', 'Name'),
                Sight::make('email', 'Email'),
            ]),
            Layout::legend('request', [
                Sight::make('title', 'Title'),
                Sight::make('text', 'Text'),
                Sight::make('status', 'Status')
                    ->render(function (Request $request) {
                        return $request::getStatuses()[$request->status];
                    }),
                Sight::make('created_at', 'Created')
                    ->render(function (Request $request) {
                        return $request->created_at;
                    }),
            ]),
            Layout::rows([
                Input::make('request.id')->hidden(),
                Input::make('user.email')->hidden(),
                TextArea::make('answer')
                    ->placeholder('Enter your answer'),
                Button::make('Send')
                    ->type(Color::DEFAULT())
                    ->icon('envelope')
                    ->method('sendAnswer'),
            ]),
        ];
    }

    public function sendAnswer(\Illuminate\Http\Request $request)
    {
        $this->sendAnswerService->handle($request->all());

        return redirect()->route('platform.pending-request');
    }
}
