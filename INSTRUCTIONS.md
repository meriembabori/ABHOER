# Notifications — Étudiant ⇄ Responsable (flux complet dans les deux sens)

## Fichiers dans ce zip

- **`app/Http/Controllers/Responsable/ResponsableNotificationController.php`** (nouveau)
  Page de notifications côté Responsable (liste, marquer lu, tout marquer lu).

- **`resources/views/responsable/notifications/index.blade.php`** (nouveau)
  Vue correspondante, thème bleu nuit.

- **`routes/web.php`** (modifié)
  3 routes ajoutées : `responsable.notifications`, `.lire`, `.lire-toutes`.

- **`resources/views/layouts/responsable.blade.php`** (modifié)
  La cloche de la topbar Responsable est un vrai lien, badge = vrai nombre de non-lues.

- **`app/Http/Controllers/EtudiantDemandeStageController.php`** (modifié)
  **Étudiant → Responsable** : dès qu'un étudiant dépose une demande
  (`storeInformations`), tous les comptes `RESPONSABLE` reçoivent une notification.

- **`app/Http/Controllers/Responsable/ResponsableDemandeController.php`** (modifié)
  **Responsable → Étudiant** (nouveau dans cette version) : l'étudiant reçoit
  maintenant une notification automatique à chacune de ces actions du responsable :

  | Action du responsable          | Méthode         | Notification envoyée à l'étudiant                     | Type     |
  |---------------------------------|-----------------|---------------------------------------------------------|----------|
  | Accepter la demande             | `accepter()`    | "Votre demande ... a été acceptée."                     | SUCCESS  |
  | Refuser la demande              | `refuser()`     | "Votre demande ... a été refusée." (+ motif si fourni)  | DANGER   |
  | Demander des infos complém.     | `demanderInfos()` | "Le responsable demande des informations complémentaires : ..." | WARNING  |
  | Affecter à un service (stage démarre) | `affecter()` | "Votre stage ... a été affecté et démarre le JJ/MM/AAAA." | SUCCESS  |

  Ces notifications utilisent une nouvelle méthode privée `notifierEtudiant()`
  qui retrouve le compte `Utilisateur` lié au `Candidat` de la demande
  (`idCandidat`), et ne fait rien si aucun compte utilisateur n'est trouvé
  (cas d'une demande déposée physiquement sans compte en ligne — pas une erreur).

## Intégration

1. Copie chaque fichier à son emplacement exact.
2. Aucune migration nécessaire.
3. Vide les caches :
   ```bash
   php artisan route:clear && php artisan view:clear
   ```

## Test du flux complet dans les deux sens

1. **Étudiant → Responsable** : un étudiant dépose une demande
   → le(s) responsable(s) voient la notification et le badge sur leur cloche.
2. **Responsable → Étudiant** : le responsable accepte / refuse / demande des
   infos / affecte un service sur cette demande
   → l'étudiant voit apparaître la notification correspondante dans
   `/etudiant/notifications`, avec un lien "Voir la demande".

## Points d'attention

- Les notifications Étudiant→Responsable partent vers **tous** les comptes
  `RESPONSABLE` (pas de ciblage par service, la structure actuelle ne le
  permet pas encore).
- `affecter()` ne notifie que si le statut passe réellement à `STAGE_EN_COURS`
  (c'est-à-dire une demande déjà `ACCEPTEE` qu'on vient d'affecter) — une
  simple modification de l'affectation sur un statut déjà `STAGE_EN_COURS`
  ne redéclenche pas de notification, pour éviter le spam si le responsable
  ajuste les dates plusieurs fois.
