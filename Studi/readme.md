# Déploiement Local de l'Application

Ce guide vous explique comment déployer l'application localement en utilisant Docker et Docker Compose. Assurez-vous d'avoir Docker et Docker Compose installés sur votre machine avant de commencer.

## Prérequis

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Instructions de Déploiement

1. Clonez le dépôt de l'application sur votre machine locale :

    ```bash
    git clone https://github.com/Nix3sS-coder/Arcadia_Studi
    cd votre-repo
    ```

2. Lancez le déploiement de l'application en utilisant Docker Compose :

    ```bash
    docker-compose up -d
    ```

    Cette commande va :
    - Construire les images Docker si elles n'existent pas déjà.
    - Démarrer les conteneurs en arrière-plan.

3. Vérifiez que les conteneurs sont en cours d'exécution :

    ```bash
    docker-compose ps
    ```

    Vous devriez voir une liste des conteneurs en cours d'exécution pour votre application.

## Accès à l'Application

Une fois les conteneurs démarrés, l'application devrait être accessible via le navigateur à l'adresse :

- [http://localhost:8080](http://localhost:8080)

(Remplacez `8080` par le port configuré dans votre fichier `docker-compose.yml` si nécessaire.)

## Arrêter les Conteneurs

Pour arrêter les conteneurs, utilisez la commande suivante :

```bash
docker-compose down
