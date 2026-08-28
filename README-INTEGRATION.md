# Intégration — Fusion complète (Étudiant + Responsable + Accueil)

## ⚠️ Important avant de commencer

Ce zip contient l'**état complet et déjà fusionné** de :
- Ta partie (Responsable + Agent + Attestations)
- La partie de ta binôme (Espace Étudiant + Inscription), récupérée depuis la branche `etudiant` sur GitHub
- La nouvelle page d'accueil publique

**Sauvegarde ton projet actuel avant de commencer** (copie le dossier entier ailleurs, ou fais un commit Git local de ce que tu as déjà), au cas où.

## 1. Ce qu'il faut remplacer ENTIÈREMENT dans ton projet

Dézippe `abhoer-complet.zip`, puis remplace ces dossiers en entier dans `C:\laragon\www\abhoer-gestion-stages\` par ceux du zip :

- `app\` (contrôleurs, modèles, middleware)
- `resources\` (toutes les vues)
- `routes\`
- `database\` (migrations + seeders)
- `bootstrap\`
- `public\images\` (juste ce sous-dossier, pas tout `public\`)

C'est plus sûr de tout remplacer d'un coup plutôt que fichier par fichier, vu le volume.

## 2. Commandes à lancer, dans l'ordre

```bash
php artisan migrate
php artisan db:seed --class=DepartementServiceSeeder
composer dump-autoload
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

## 3. Comptes de test à créer (si pas déjà fait)

```bash
php artisan tinker --execute="\App\Models\Utilisateur::firstOrCreate(['login' => 'responsable'], ['nom' => 'Test', 'prenom' => 'Responsable', 'motDePasse' => bcrypt('password123'), 'role' => 'RESPONSABLE', 'actif' => 1]);"
```

Pour un compte étudiant, utilise directement le formulaire `/inscription` dans le navigateur (plus simple que Tinker).

## 4. Ce que tu dois tester

1. **Page d'accueil** : va sur `/` — tu dois voir le hero animé avec vagues, la section À propos, les 6 services, la carte de localisation, la galerie photo.
2. **Inscription** : clique sur "S'inscrire", crée un compte étudiant test.
3. **Connexion étudiant** : connecte-toi avec ce compte → tu dois arriver sur `/etudiant/dashboard`.
4. **Connexion responsable** : connecte-toi avec le compte `responsable` → tu dois arriver sur `/responsable/dashboard`, avec tout ce qu'on a construit (demandes, stages, historique, attestations).
5. **Vérifie qu'un étudiant ne peut PAS accéder à `/responsable/dashboard`** (doit afficher une erreur 403 "Vous n'avez pas accès à cette section").

## 5. Ce qui a été résolu pendant la fusion

- **Conflit de route et de contrôleur de connexion** (`LoginController.php`, `routes/web.php`) : fusionnés pour gérer les 3 rôles (`ADMINISTRATEUR`, `RESPONSABLE`/`AGENT`, `ETUDIANT`).
- **Conflit de colonne base de données** : toi et ta binôme aviez chacune ajouté une colonne `theme` à `demande_stage` dans deux migrations séparées. La tienne a été corrigée pour ne garder que `typeStage` (la colonne `theme` vient maintenant uniquement de sa migration à elle).
- **Design unifié** : la couleur bleue qu'elle utilisait (`#08608c`) a été remplacée par ta palette turquoise (`#1a7a86`) sur toutes les pages étudiant, pour que l'application ait un seul style cohérent de bout en bout.
- **Logo et lien d'inscription** ajoutés sur la page de connexion et le dashboard étudiant.

## 6. Une fois que tout fonctionne

```bash
git add -A
git commit -m "Fusion espace Étudiant + Responsable + Attestations + page d'accueil"
git push
```

Ça enregistre la fusion dans ton historique Git local et la publie sur GitHub.
