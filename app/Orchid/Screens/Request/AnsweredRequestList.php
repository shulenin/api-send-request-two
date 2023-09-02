<?php

namespace App\Orchid\Screens\Request;

use App\Orchid\Layouts\Request\AnsweredRequestListLayout;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AnsweredRequestList extends Screen
{
    public function __construct(private RequestRepository $repository) {}

    public function query(): iterable
    {
        return [
            'data' => $this->repository->getAllByAnsweredStatus(),
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

    public function clear(Request $request)
    {
        $request = \App\Models\Request::query()
            ->where('id','=', $request->get('id'))
            ->first();

        $request->delete();

        Toast::success('Request is deleted');
    }
}
