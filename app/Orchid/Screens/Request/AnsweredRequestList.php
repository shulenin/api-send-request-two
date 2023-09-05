<?php

namespace App\Orchid\Screens\Request;

use App\Models\Request;
use App\Orchid\Layouts\Request\AnsweredRequestListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AnsweredRequestList extends Screen
{
    public function query(): iterable
    {
        return [
            'data' => Request::query()
                ->with('user')
                ->answered()
                ->orderBy('id', 'DESC')
                ->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Answered requests';
    }

    /**
     * @inheritDoc
     */
    public function layout(): iterable
    {
        return [
            AnsweredRequestListLayout::class,
        ];
    }

    public function clear(\Illuminate\Http\Request $request)
    {
        $request = Request::query()
            ->byId($request->get('id'))
            ->first();

        $request->delete();

        Toast::success('Request is deleted');
    }
}
