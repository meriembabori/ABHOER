# Connexion par login OU par email

## Le problème

La table `utilisateur` (les comptes de connexion) n'avait qu'une colonne
`login`, pas d'`email` — donc même si le formulaire affichait déjà
« Adresse e-mail ou identifiant », le contrôleur ne cherchait que par `login`.

## Fichiers modifiés / créés

- **`database/migrations/2026_09_04_100000_add_email_to_utilisateur_table.php`** (nouveau)
  Ajoute une colonne `email` (nullable, unique) à `utilisateur`, et
  **rétro-remplit automatiquement** l'email des comptes étudiants déjà
  existants à partir de leur fiche `candidat` (qui a toujours eu un email).
  → Aucune action manuelle nécessaire pour les étudiants déjà inscrits.

- **`app/Models/Utilisateur.php`** (modifié)
  Ajout de `'email'` dans `$fillable`.

- **`app/Http/Controllers/InscriptionController.php`** (modifié)
  À l'inscription, l'email saisi par l'étudiant est maintenant aussi
  enregistré dans son compte `utilisateur` (avant, il n'était sauvegardé
  que dans `candidat`).

- **`app/Http/Controllers/LoginController.php`** (modifié)
  La recherche du compte se fait maintenant par :
  ```php
  Utilisateur::where('login', $validated['login'])
      ->orWhere('email', $validated['login'])
      ->first();
  ```
  Le champ du formulaire s'appelle toujours `login`, mais accepte
  indifféremment un identifiant ou une adresse email.

## Intégration

1. Copie les 4 fichiers à leurs emplacements exacts.
2. Lance la migration :
   ```bash
   php artisan migrate
   ```
3. Vide les caches si besoin :
   ```bash
   php artisan config:clear && php artisan route:clear
   ```

## Test

- Étudiant existant → se connecte avec son **login habituel** (fonctionne
  comme avant) **ou** avec l'**email** utilisé à l'inscription (nouveau).
- Nouvel étudiant qui s'inscrit → peut immédiatement utiliser les deux.

## À savoir

- Les comptes **Responsable / Administrateur / Agent** créés depuis
  l'espace Admin n'ont pas d'email pour l'instant (le formulaire de
  création ne demande pas d'email) — ils continueront donc à se connecter
  uniquement par login, tant qu'aucun email ne leur est renseigné.
  Si tu veux que je l'ajoute aussi pour ces rôles (champ email dans le
  formulaire de création admin + migration déjà prête à l'accueillir),
  dis-le-moi.
