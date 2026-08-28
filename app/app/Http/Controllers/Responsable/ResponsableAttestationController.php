<?php

namespace App\Http\Controllers\Responsable;

use App\Http\Controllers\Controller;
use App\Models\Attestation;
use App\Models\DemandeStage;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsableAttestationController extends Controller
{
    /**
     * Liste des attestations, avec recherche et filtre par statut.
     * Les demandes acceptées sans attestation apparaissent aussi (statut "NON_DEMANDEE").
     */
    public function index(Request $request)
    {
        $query = DemandeStage::with(['candidat', 'service', 'attestation'])
            ->where('statut', 'ACCEPTEE');

        if ($request->filled('recherche')) {
            $recherche = $request->recherche;

            $query->where(function ($q) use ($recherche) {
                $q->where('numeroDemande', 'like', "%{$recherche}%")
                    ->orWhereHas('candidat', function ($qc) use ($recherche) {
                        $qc->where('nom', 'like', "%{$recherche}%")
                            ->orWhere('prenom', 'like', "%{$recherche}%");
                    });
            });
        }

        $demandes = $query->orderByDesc('dateDepot')->paginate(12)->withQueryString();

        if ($request->filled('statut')) {
            $statutFiltre = $request->statut;

            $demandes->setCollection(
                $demandes->getCollection()->filter(function ($demande) use ($statutFiltre) {
                    $statutActuel = optional($demande->attestation)->statut ?? 'NON_DEMANDEE';
                    return $statutActuel === $statutFiltre;
                })
            );
        }

        return view('responsable.attestations.index', compact('demandes'));
    }

    /**
     * Démarrer la préparation de l'attestation pour une demande acceptée.
     */
    public function demarrer(Request $request, $idDemande)
    {
        $demande = DemandeStage::findOrFail($idDemande);

        $attestation = Attestation::firstOrCreate(
            ['idDemande' => $demande->idDemande],
            [
                'statut' => 'EN_PREPARATION',
                'datePreparation' => now(),
            ]
        );

        $this->logHistorique($demande->idDemande, 'ATTESTATION_PREPARATION', null, 'Préparation démarrée');

        return back()->with('success', "Préparation de l'attestation démarrée pour {$demande->numeroDemande}.");
    }

    /**
     * Marquer l'attestation comme prête à être récupérée.
     */
    public function marquerPrete(Request $request, $id)
    {
        $attestation = Attestation::findOrFail($id);

        $attestation->statut = 'PRETE';
        $attestation->dateDisponibilite = now();
        $attestation->save();

        $this->logHistorique($attestation->idDemande, 'ATTESTATION_PRETE', 'EN_PREPARATION', 'PRETE');

        return back()->with('success', 'Attestation marquée comme prête à récupérer.');
    }

    /**
     * Marquer l'attestation comme remise à l'étudiant.
     */
    public function marquerRemise(Request $request, $id)
    {
        $attestation = Attestation::findOrFail($id);

        $attestation->statut = 'REMISE';
        $attestation->dateRemise = now();
        $attestation->save();

        $this->logHistorique($attestation->idDemande, 'ATTESTATION_REMISE', 'PRETE', 'REMISE');

        return back()->with('success', 'Attestation marquée comme remise.');
    }

    private function logHistorique(int $idDemande, string $action, ?string $ancienneValeur, string $nouvelleValeur): void
    {
        Historique::create([
            'idUtilisateur' => Auth::id(),
            'idDemande' => $idDemande,
            'action' => $action,
            'dateAction' => now(),
            'ancienneValeur' => $ancienneValeur,
            'nouvelleValeur' => $nouvelleValeur,
        ]);
    }
}
