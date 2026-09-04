<?php

namespace App\Providers;

use App\Models\Candidat;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(
            ['layouts.admin', 'layouts.responsable', 'layouts.etudiant'],
            function ($view) {

                $notifications = collect();
                $notificationsNonLues = 0;

                if (Auth::check()) {

                    $notifications = Notification::where(
                        'idUtilisateur',
                        Auth::user()->idUtilisateur
                    )
                    ->orderByDesc('created_at')
                    ->limit(6)
                    ->get();

                    $notificationsNonLues = Notification::where(
                        'idUtilisateur',
                        Auth::user()->idUtilisateur
                    )
                    ->where('lu', false)
                    ->count();
                }

                $view->with([
                    'topbarNotifications' => $notifications,
                    'topbarNotificationsNonLues' => $notificationsNonLues,
                    'sidebarPhoto' => (Auth::check() && Auth::user()->idCandidat)
                        ? optional(Candidat::find(Auth::user()->idCandidat))->photo
                        : null,
                ]);
            }
        );
    }
}
