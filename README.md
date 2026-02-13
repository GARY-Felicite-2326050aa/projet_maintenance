Bien sûr ! Voici un exemple de **README.md** structuré et clair pour ton projet Symfony, incluant l’installation, l’exécution des tests, le hook script, et les métriques avec PHP Metrics. J’ai intégré les détails que tu as fournis.

---

# Projet Maintenance Symfony

## Description

Ce projet est développé en **Symfony 6** avec **PHP 8.3**.
Il contient des fonctionnalités CRUD pour les entités **Sport** et **Épreuve**, ainsi que des tests automatisés avec **PHPUnit** et des métriques de qualité avec **PHP Metrics**.

---

## Prérequis

* PHP ≥ 8.3
* Composer
* Python3 / Anaconda (pour certains scripts ou tests)
* SQLite / MySQL (selon configuration)
* Symfony CLI (optionnel mais recommandé)
* Bash (pour exécuter le script `installHooks.sh`)

---

## Installation

1. **Cloner le projet** :

```bash
git clone <url_du_repo>
cd projet_maintenance
```

2. **Installer les dépendances** :

```bash
composer install
```

3. **Créer la base de données** (environnement dev) :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

4. **Créer la base de données de test** :

```bash
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:update --force --env=test
```

---

## Commandes utiles

### Lancer les migrations

```bash
php bin/console doctrine:migrations:diff    # Crée une nouvelle migration
php bin/console doctrine:migrations:migrate # Exécute les migrations
```

### Exécuter les tests PHPUnit

```bash
# Tous les tests
php bin/phpunit

# Test d’un fichier spécifique
php bin/phpunit tests/Controller/SportControllerTest.php
```
 **Remarque :** Les tests peuvent nécessiter les variables d’environnement suivantes :

```dotenv
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data_dev.db"
DEFAULT_URI="http://localhost"
```

Pour les configurer, créez un fichier `.env.test` avec ces variables.

---

### Nettoyer le cache

```bash
php bin/console cache:clear --env=dev
php bin/console cache:clear --env=test
```

---

## Scripts Bash

### Hook Git pour tests automatiques

Le projet contient un script pour installer des hooks Git (pré-commit) afin d’exécuter automatiquement les tests et les métriques avant chaque commit :

```bash
bash initscript/installHooks.sh
```

Le hook exécutera :

* `php bin/phpunit` → pour vérifier que tous les tests passent
* `vendor/bin/phpmetrics --report-html=metrics src` → pour générer un rapport de qualité de code HTML dans le dossier `metrics`

---

## PHP Metrics

Pour analyser la qualité du code, utilisez **PHP Metrics** :

```bash
vendor/bin/phpmetrics --report-html=metrics src
```

* Le rapport HTML sera généré dans le dossier `metrics/`.
* Il inclut des indicateurs comme :

  * Complexité cyclomatique
  * Couverture de code
  * Couplage et maintenabilité
  * Taille et structure des classes

---

## Exécution des tests Python (optionnel)

Pour certains scripts ou tests Python inclus dans le projet :

```bash
python3 <script.py>
# ou via Anaconda
Anaconda3 <script.py>
```

---

## Remarques importantes

* Certains tests PHPUnit peuvent échouer si les variables d’environnement `DATABASE_URL` ou `DEFAULT_URI` ne sont pas définies.
* Les erreurs fréquentes dans les tests concernent :

  * Champs de formulaire non trouvés (`Unreachable field "type"` ou `"description"`)
  * Redirections HTTP non attendues (301 → 302)
  * Type de données incorrect dans les entités

---

## Structure du projet

```
projet_maintenance/
│
├─ src/                   # Code source PHP
├─ tests/                 # Tests PHPUnit
├─ migrations/            # Fichiers de migrations Doctrine
├─ metrics/               # Rapports PHP Metrics
├─ initscript/            # Scripts Bash, hooks Git
├─ var/                   # Cache et base de données SQLite
└─ vendor/                # Dépendances Composer
```
