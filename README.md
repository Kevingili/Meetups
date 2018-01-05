CRUD Meetups
---------------------------------

## Présentation de l'application

L'acronyme informatique anglais CRUD (pour create, read, update, delete) (parfois appelé SCRUD avec un "S" pour search) désigne les quatre opérations de base pour la persistance des données, en particulier le stockage d'informations en base de données.

Ce projet est donc une application en ZF3 qui permet de voir, créer, modifier et supprimer des meetups.

## Commandes utiles

```
git clone https://github.com/Kevingili/Meetups.git

cd Meetups/

docker-compose up -d

docker-compose run --rm zf php vendor/bin/doctrine-module

composer install
composer development-enable

docker-compose run --rm zf php vendor/bin/doctrine-module
docker-compose run --rm zf php vendor/bin/doctrine-module orm:info
docker-compose run --rm zf php vendor/bin/doctrine-module orm:validate-schema
docker-compose run --rm zf php vendor/bin/doctrine-module orm:schema-tool:update --dump-sql
docker-compose run --rm zf php vendor/bin/doctrine-module orm:schema-tool:update --force
docker-compose run --rm zf php vendor/bin/doctrine-module orm:validate-schema


docker-compose run --rm database mysql -h database -u demo -p demo
```