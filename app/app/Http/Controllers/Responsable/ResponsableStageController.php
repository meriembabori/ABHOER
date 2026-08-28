<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Affectation;
use Illuminate\Http\Request;

class ResponsableStageController extends Controller
{
    /**
     * Suivi des stages affectés : à venir, en cours, terminés.
     */
    public function index(Request $request)
    {
        $onglet = $request->get('statut', 'en_cours');

        $query = Affectation::with(['demande.candidat', 'service']);

        $today = now()->toDateString();

        switch ($onglet) {
            case 'a_venir':
                $query->whereDate('dateDebut', '>', $today);
                break;

            case 'termine':
                $query->whereDate('dateFin', '<', $today);
                break;

            case 'en_cours':
            default:
                $query->whereDate('dateDebut', '<=', $today)
                    ->whereDate('dateFin', '>=', $today);
                break;
        }

        $affectations = $query->orderBy('dateDebut')->paginate(12)->withQueryString();

        $compteurs = [
            'a_venir' => Affectation::whereDate('dateDebut', '>', $today)->count(),
            'en_cours' => Affectation::whereDate('dateDebut', '<=', $today)->whereDate('dateFin', '>=', $today)->count(),
            'termine' => Affectation::whereDate('dateFin', '<', $today)->count(),
        ];

        return view('responsable.stages.index', compact('affectations', 'onglet', 'compteurs'));
    }
}
