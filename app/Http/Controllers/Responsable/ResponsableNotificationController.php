<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResponsableNotificationController extends Controller
{
    /**
     * Afficher les notifications du responsable connecté.
     */
    public function index(): View
    {
        $idUtilisateur = Auth::user()->idUtilisateur;

        $notifications = Notification::where(
            'idUtilisateur',
            $idUtilisateur
        )
        ->orderByDesc('created_at')
        ->get();

        $notificationsNonLues = $notifications
            ->where('lu', false)
            ->count();

        return view(
            'responsable.notifications.index',
            compact(
                'notifications',
                'notificationsNonLues'
            )
        );
    }

    /**
     * Marquer une notification comme lue.
     */
    public function lire(int $idNotification): RedirectResponse
    {
        $notification = Notification::where(
            'idNotification',
            $idNotification
        )
        ->where(
            'idUtilisateur',
            Auth::user()->idUtilisateur
        )
        ->firstOrFail();

        $notification->lu = true;
        $notification->save();

        return redirect()->back();
    }

    /**
     * Marquer toutes les notifications comme lues.
     */
    public function lireToutes(): RedirectResponse
    {
        Notification::where(
            'idUtilisateur',
            Auth::user()->idUtilisateur
        )
        ->where('lu', false)
        ->update([
            'lu' => true,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Toutes les notifications ont été marquées comme lues.'
            );
    }
}
