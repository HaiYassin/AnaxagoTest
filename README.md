Anaxago symfony-starter-kit
===================

# Description

Ce projet est un kit de démarage avec :
- Symfony 3.4 minimum
- php 7.1 minimum

La base de données contient deux tables :
- user => pour la gestion et la connexion des utilisateurs 
- project => pour la liste des projets

Les données préchargés sont
- pour les users 

| email     | password    | Role |
| ----------|-------------|--------|
| john@local.com  | john   | ROLE_USER    |
| admin@local.com | admin | ROLE_ADMIN   | 

 - une liste de 3 projets
 
La connexion et l'enregistrement des utilisateurs sont déjà configurés et opérationnels


# Installation
- ```composer install```
- ```composer init-db ```

    - Script personnalisé permet de créer la base de données, de lancer la création du schéma et de précharger les données
    - Ce script peut être réutilisé pour ré-initialiser la base de données à son état initial à tout moment

Lancer les tests : 
Se placer sur le repertoire du projet et faire :
```vendor\bin\simple-phpunit```

Pour aller plus loin : 
- Utiliser Docker.
- Dissocier les tests unitaires aux fonctionnels. 
- Utiliser les migrations.
- Pour l'api simplifié utilisé ApiPlatform, car FosRestBundle est déprécié.
- Système de Workflow, pour gérer les states des Projects au Flush avec WorkflowComponent de SensioLab.

Test des requêtes de l'api avec Postman :
url : https://www.getpostman.com/


