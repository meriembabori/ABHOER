# ABHOER — Projet fusionné (branche `integration-design-meriem`)

Ce projet est le résultat de la fusion entre ton dépôt (design, page d'accueil, espace
Responsable, attestations) et celui d'Imane (backend Étudiant/Admin, base fonctionnelle).
Base de départ : le dépôt d'Imane, sur une nouvelle branche Git dédiée, pour ne rien
écraser dans vos dépôts d'origine.

## Comment démarrer

```bash
composer install
npm install && npm run build   # ou npm run dev en local
cp .env.example .env
php artisan key:generate

# Créer la base MySQL (nom vu dans .env.example : à adapter),
# puis importer le schéma de base :
mysql -u root -p ton_nom_de_base < database/abhoer_stages.sql

# Ensuite, appliquer les migrations supplémentaires par-dessus :
php artisan migrate

php artisan serve
```

⚠️ Le schéma de base (tables `candidat`, `demande_stage`, `service`, `utilisateur`, etc.)
vient du dump SQL `database/abhoer_stages.sql`, **pas** des migrations Laravel classiques.
Les migrations dans `database/migrations/` ne font qu'ajouter des colonnes/tables
par-dessus ce schéma de base. Il faut donc importer le dump **avant** de lancer
`php artisan migrate`, sinon les migrations vont échouer (tables introuvables).

## Ce qui a été fusionné

### Backend (conservé depuis le dépôt d'Imane)
- Tous les contrôleurs, modèles, routes des espaces Étudiant et Admin
- Les améliorations qu'elle avait apportées à l'espace Responsable (vérification
  anti-doublon du numéro de demande, validation des fichiers uploadés, champ `motivation`)

### Ajouts intégrés depuis ton projet local
- **Système d'attestations** (entièrement nouveau, absent chez Imane) :
  modèle `Attestation`, migration, contrôleur `ResponsableAttestationController`,
  vue `responsable/attestations/index.blade.php`, routes dédiées
- **Page d'accueil réelle** : `AccueilController` + vues `accueil/*` + galerie photos
  du bassin (`public/images/bassin/`)
- **2 migrations essentielles** que le dépôt d'Imane utilisait sans les avoir committées
  (`add_id_candidat_to_utilisateur_table`, `modify_role_enum_in_utilisateur_table`) —
  sans elles, l'inscription étudiante d'Imane aurait échoué sur une base fraîchement
  importée
- **Design** : layouts `public`, `etudiant`, `responsable`, pages de connexion et
  d'inscription, et toutes les vues de l'espace Responsable (dashboard, demandes,
  historique, stages, attestations)

### Corrections de cohérence effectuées pendant la fusion
Certains noms de routes différaient légèrement entre les vues et les fichiers de routes
des deux projets (ex. `etudiant.demande.index` vs `etudiant.demandes.index`,
`inscription.register` vs `inscription.store`). J'ai harmonisé tout ça sur la convention
du dépôt d'Imane (base fonctionnelle retenue) et vérifié route par route qu'aucune vue
Responsable n'appelle une route inexistante.

**Validation effectuée :** `php artisan route:list` s'exécute sans erreur avec les 72
routes de l'application (accueil, auth, étudiant, responsable, admin) toutes résolues
correctement vers un contrôleur existant.

## Ce qui n'a PAS été fait (travail restant)

1. **Design de l'espace Admin** : il garde le design original d'Imane. Tu n'avais pas
   encore de design Admin dans ton projet local à intégrer — si tu en crées un, je
   pourrai faire la même passe de restylage que pour le Responsable.

2. **Restylage fin des vues Étudiant** : les vues Étudiant utilisées sont celles
   d'Imane (plus complètes : gestion documents, notifications, etc.), habillées par
   ton nouveau layout `layouts/etudiant.blade.php`. La structure générale (sidebar,
   navbar, couleurs) est donc déjà la tienne, mais le contenu détaillé de chaque page
   (tableaux, cartes, formulaires) garde encore le style d'Imane à l'intérieur. Tu avais
   toi-même commencé une version Étudiant avec ton design — si tu veux, dans un prochain
   passage je peux reprendre page par page (dashboard, liste des demandes, nouvelle
   demande, profil) et les restyler avec tes gabarits, en conservant les données fournies
   par les contrôleurs d'Imane.

3. **Test réel en base de données** : je n'ai pas pu monter un vrai MySQL dans mon
   environnement d'exécution pour tester le cycle complet (import du dump + migrations +
   navigation dans les 3 espaces). `route:list` confirme que le routage et le chargement
   des classes sont corrects, mais un test fonctionnel de bout en bout reste à faire de
   ton côté avec `php artisan migrate:status` et en naviguant dans l'app.

4. **Git** : ce projet est sur une branche locale `integration-design-meriem`, avec un
   commit propre résumant les changements. Rien n'a été poussé sur GitHub — à toi de
   relier ce dossier à un remote (le tien ou celui d'Imane) et de pousser quand tu es
   satisfaite du résultat.

## Vérifications à faire de ton côté (checklist du cahier des charges)

```bash
php artisan route:list        # ✅ déjà validé ici
php artisan migrate:status    # à faire après import du dump SQL
php artisan serve
```

Puis tester manuellement : accueil, connexion (les 3 rôles), inscription étudiante,
dashboard + demandes + profil Étudiant, dashboard + demandes + attestations Responsable,
dashboard + utilisateurs/services/départements Admin.
