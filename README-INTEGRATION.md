# Intégration — Bootstrap Icons + nouvelles photos

## Pourquoi ce changement
Les icônes Tabler ne s'affichaient pas (le CDN ne se chargeait pas correctement chez toi).
On passe sur **Bootstrap Icons** (CDN jsDelivr, plus fiable), comme tu l'as demandé.

## 1. Fichiers à remplacer entièrement (16 vues + 1 contrôleur)
Toutes les vues qui contenaient des icônes ont été mises à jour — remplace-les avec celles du zip :
- `resources/views/accueil/services.blade.php`
- `resources/views/accueil/localisation.blade.php`
- `resources/views/accueil/index.blade.php`
- `resources/views/layouts/responsable.blade.php`
- `resources/views/layouts/public.blade.php`
- `resources/views/layouts/etudiant.blade.php`
- `resources/views/auth/inscription.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/etudiant/dashboard.blade.php`
- `resources/views/responsable/dashboard.blade.php`
- `resources/views/responsable/demandes/create.blade.php`
- `resources/views/responsable/demandes/index.blade.php`
- `resources/views/responsable/demandes/show.blade.php`
- `resources/views/responsable/attestations/index.blade.php`
- `resources/views/responsable/stages/index.blade.php`
- `resources/views/responsable/historique/index.blade.php`
- `app/Http/Controllers/AccueilController.php`

## 2. Photos à remplacer/ajouter dans `public/images/`
- `logo-abhoer.png` → nouveau logo officiel (remplace l'existant)
- `bassin/siege-abhoer.jpeg` → nouvelle photo (siège de l'agence)
- `bassin/barrage-al-massira.jpeg` → nouvelle photo (barrage Al Massira)
- `bassin/barrage-1.jpeg` et `bassin/barrage-2.jpeg` → remplacées par des versions plus propres (sans la barre de statut du téléphone visible avant)

Copie tout le contenu de `public/images/` du zip par-dessus ton dossier `public/images/` existant (remplace les fichiers de même nom, ajoute les nouveaux).

## 3. Après copie
```bash
php artisan view:clear
php artisan config:clear
```
Pas de `composer dump-autoload` nécessaire cette fois (juste des vues + 1 contrôleur, pas de nouvelle classe).

## 4. Test
1. Recharge `/` en forçant le cache (Ctrl+Shift+R) — les icônes doivent maintenant s'afficher partout (navbar, cartes, boutons)
2. Vérifie la page `/localisation` — la photo du siège doit apparaître au-dessus des infos d'adresse
3. Vérifie la section "À propos" de l'accueil — la photo doit être celle du barrage Al Massira (avec les 2 jets d'eau)
