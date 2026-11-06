# test

[![CI](https://github.com/flyzig/test/actions/workflows/ci.yml/badge.svg)](https://github.com/flyzig/test/actions/workflows/ci.yml)

Site WordPress local pour tester des plugins.

## Installation locale

1. Copier `wp-config-sample.php` en `wp-config.php` et renseigner la base de données.
2. Ouvrir `http://localhost/perso/test/` pour lancer l'installation.

## CI (GitHub Actions)

À chaque push sur `main` ou pull request, GitHub exécute [.github/workflows/ci.yml](.github/workflows/ci.yml) :

| Job | Rôle | Bloquant |
|---|---|---|
| Syntaxe PHP | `php -l` sur les plugins, PHP 7.4 → 8.4 | oui |
| WordPress Coding Standards | style de code (PHPCS + WPCS) | non (informatif) |
| Test WordPress + plugin | installe WP + MySQL, active les plugins, teste le shortcode, vérifie `debug.log` | oui |

Résultats : onglet **Actions** du dépôt.

**Ajouter un plugin au CI :** ajouter le nom de son dossier dans la variable `PLUGINS` en haut de `ci.yml`.
