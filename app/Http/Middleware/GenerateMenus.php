<?php

namespace App\Http\Middleware;

use App\Models\SessionKeyModel;
use Closure;
use Illuminate\Support\Facades\Request;
use Menu;
use Session;

class GenerateMenus {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        Menu::make('backend_sidebar', function ($menu) {
            $menu->add('<i class=" bi bi-grid"></i> Dashboard', [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
                ->data([
                    'order'         => 1,
                    'activematches' => 'control/dashboard*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            $reports = $menu->add('<i class="bi bi-menu-button-wide"></i> Reports <i class="bi bi-chevron-down ms-auto"></i>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 2,
                    'activematches' => 'control/report*',
                ]);
            $reports->link->attr([
                'class' => 'nav-link',
                'href'  => '#',
                'data-bs-target' => "#report-nav",
                'data-bs-toggle' => "collapse"
            ]);

            $reports->add('<i class="bi bi-circle"></i> General', [
                'route' => 'backend.report_general',
            ])
                ->data([
                    'order'         => 100,
                    'activematches' => 'control/report-general',
                ])
                ->link->attr([
                    //'class' => 'nav-link',
                ]);

            $menu->add('<i class=" bi bi-person"></i> Withdraws', [
                'route' => 'backend.withdraws',
                'class' => 'nav-item',
            ])
                ->data([
                    'order'         => 3,
                    'activematches' => 'control/withdraws*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            $userSession = Session::get(SessionKeyModel::USER_LOGIN);
            if($userSession->tipe_user === 'admin'){
                $menu->add('<i class=" bi bi-person"></i> Users', [
                    'route' => 'backend.users',
                    'class' => 'nav-item',
                ])
                    ->data([
                        'order'         => 3,
                        'activematches' => 'control/users*',
                    ])
                    ->link->attr([
                        'class' => 'nav-link',
                    ]);
            }


            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = (is_string($item->activematches)) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
