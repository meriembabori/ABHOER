<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Marquer une notification comme lue puis rediriger vers la demande liée
     * si elle existe, sinon revenir à la page précédente.
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

        if ($notification->idDemande) {

            $role = strtoupper(trim(Auth::user()->role));

            if ($role === 'ADMINISTRATEUR' && \Illuminate\Support\Facades\Route::has('admin.demandes.show')) {
                return redirect()->route('admin.demandes.show', $notification->idDemande);
            }

            if ($role === 'RESPONSABLE' && \Illuminate\Support\Facades\Route::has('responsable.demandes.show')) {
                return redirect()->route('responsable.demandes.show', $notification->idDemande);
            }
        }

        return redirect()->back();
    }

    /**
     * Marquer toutes les notifications de l'utilisateur connecté comme lues.
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

        return redirect()->back()->with(
            'success',
            'Toutes les notifications ont été marquées comme lues.'
        );
    }
}
