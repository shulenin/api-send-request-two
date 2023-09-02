<?php

namespace App\Orchid\Screens\Request;

use App\Orchid\Layouts\Request\PendingRequestListLayout;
use App\Repositories\RequestRepository;
use Orchid\Screen\Screen;

class PendingRequestList extends Screen
{
    public function __construct(private RequestRepository $repository) {}

    public function query(): iterable
    {
        return [
            'data' => $this->repository->getAllByPendingStatus(),
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
