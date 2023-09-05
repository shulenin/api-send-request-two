<?php

namespace App\Orchid\Screens\Request;

use App\Models\Request;
use App\Orchid\Layouts\Request\PendingRequestListLayout;
use Orchid\Screen\Screen;

class PendingRequestList extends Screen
{
    public function query(): iterable
    {
        return [
            'data' => Request::query()
                ->with('user')
                ->pending()
                ->orderBy('id', 'DESC')
                ->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Pending requests';
    }

    /**
     * @inheritDoc
     */
    public function layout(): iterable
    {
        return [
            PendingRequestListLayout::class,
        ];
    }
}
