<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Repositories\RequestRepository;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Requests')->list([
                Menu::make('Pending requests')
                    ->icon('clock')
                    ->badge(function () {
                        $requestRepository = new RequestRepository();
                        return $requestRepository->getCountByPendingStatus();
                    })
                    ->route('platform.pending-request'),
                Menu::make('Answered requests')
                    ->icon('check')
                    ->badge(function () {
                        $requestRepository = new RequestRepository();
                        return $requestRepository->getCountByAnsweredStatus();
                    })
                    ->route('platform.answered-request'),
            ])->icon('text-center'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [];
    }
}
