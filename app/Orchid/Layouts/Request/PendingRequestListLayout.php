<?php

namespace App\Orchid\Layouts\Request;

use App\Models\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PendingRequestListLayout extends Table
{
    public $target = 'data';

    /**
     * @inheritDoc
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Title'),
            TD::make('user.name', 'Name'),
            TD::make('user.email', 'Email'),
            TD::make('View')
                ->render(function (Request $model) {
                    return Link::make()
                        ->route('platform.pending-request.view', $model->id)
                        ->icon('eye');
                }),
        ];
    }
}
