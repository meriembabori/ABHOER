<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Historique;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ResponsableHistoriqueController extends Controller
{
    /**
     * Historique complet des actions, toutes demandes confondues.
     */
    public function index(Request $request)
    {
        $query = Historique::with(['utilisateur', 'demande.candidat']);

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('idUtilisateur')) {
            $query->where('idUtilisateur', $request->idUtilisateur);
        }

        if ($request->filled('dateDebut')) {
            $query->whereDate('dateAction', '>=', $request->dateDebut);
        }

        if ($request->filled('dateFin')) {
            $query->whereDate('dateAction', '<=', $request->dateFin);
        }

        if ($request->filled('recherche')) {
            $recherche = $request->recherche;

            $query->whereHas('demande', function ($q) use ($recherche) {
                $q->where('numeroDemande', 'like', "%{$recherche}%");
            });
        }

        $historiques = $query->orderBy('dateAction', 'desc')->paginate(20)->withQueryString();

        $actionsDisponibles = Historique::select('action')->distinct()->pluck('action');

        $utilisateurs = Utilisateur::orderBy('nom')->get();

        return view('responsable.historique.index', compact(
            'historiques',
            'actionsDisponibles',
            'utilisateurs'
        ));
    }
}
