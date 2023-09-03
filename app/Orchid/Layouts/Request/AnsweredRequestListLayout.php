<?php

namespace App\Orchid\Layouts\Request;

use App\Models\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AnsweredRequestListLayout extends Table
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
            TD::make('Clear')
                ->render(function (Request $model) {
                    return Button::make()
                        ->icon('trash')
                        ->method('clear')
                        ->confirm('Are you sure you want to delete the entry?')
                        ->parameters([
                            'id' => $model->id,
                        ]);
                }),
        ];
    }
}
