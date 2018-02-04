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

## Partie test

### Selenium

Pour les tests Selenium il faut installer l'extension chrome suivante : https://chrome.google.com/webstore/detail/selenium-ide/mooikfkahbdckldjjndioackbalphokd
Malheureusement elle n'est pas disponible pour la version 57 de Firefox
Il faut ensuite importer le projet "Selenium Meetup.side" et on accède ensuite à plusieurs tests:
  - TestAddEmptyMeetup
  - TestAddMeetup
  - TestAddMeetup2
  - TestEditMeetup
  - TestRemoveMeetup
  
### Behat

Pour les tests behat une fois le docker-compose up -d lancer, il suffit de lancer la commande suivante
```
docker-compose run --rm zf php vendor/bin/behat
```

Si tout se passe bien, vous devriez obtenir le résultat suivant:
```
Feature: Meetup
  In order to create a meetup
  As guest
  I need to give a title, date begin, date end and description
  
  Rules:
  - field can't be empty
  - date begin must be like XX-XX-XXXX and must be a correct date
  - date end must be like XX-XX-XXXX and must be a correct date
  - date begin must be inferior to date end

  Scenario: Create a meetup with correct field     # features/meetup.feature:14
    Given I am on "/meetups/new"                   # FeatureContext::iAmOn()
    When I fill in "Title" with "Title"            # FeatureContext::iFillInWith()
    And I fill in "Date Begin" with "2018-04-04"   # FeatureContext::iFillInWith()
    And I fill in "Date End" with "2018-05-05"     # FeatureContext::iFillInWith()
    And I fill in "Description" with "Description" # FeatureContext::iFillInWith()
    And I press "Submit"                           # FeatureContext::iPress()
    Then The meetup should be true                 # FeatureContext::theMeetupShouldBeTrue()

  Scenario: Create a meetup with wrong date        # features/meetup.feature:23
    Given I am on "/meetups/new"                   # FeatureContext::iAmOn()
    When I fill in "Title" with "Title"            # FeatureContext::iFillInWith()
    And I fill in "Date Begin" with "aaaaaa"       # FeatureContext::iFillInWith()
    And I fill in "Date End" with "2018-05-05"     # FeatureContext::iFillInWith()
    And I fill in "Description" with "Description" # FeatureContext::iFillInWith()
    And I press "Submit"                           # FeatureContext::iPress()
    Then The meetup should be false                # FeatureContext::theMeetupShouldBeFalse()

  Scenario: Create a meetup with empty title       # features/meetup.feature:32
    Given I am on "/meetups/new"                   # FeatureContext::iAmOn()
    When I fill in "Title" with " "                # FeatureContext::iFillInWith()
    And I fill in "Date Begin" with "2018-04-04"   # FeatureContext::iFillInWith()
    And I fill in "Date End" with "2018-05-05"     # FeatureContext::iFillInWith()
    And I fill in "Description" with "Description" # FeatureContext::iFillInWith()
    And I press "Submit"                           # FeatureContext::iPress()
    Then The meetup should be false                # FeatureContext::theMeetupShouldBeFalse()

  Scenario: Create a meetup with date begin superior to date end # features/meetup.feature:41
    Given I am on "/meetups/new"                                 # FeatureContext::iAmOn()
    When I fill in "Title" with "Title"                          # FeatureContext::iFillInWith()
    And I fill in "Date Begin" with "2018-09-09"                 # FeatureContext::iFillInWith()
    And I fill in "Date End" with "2018-05-05"                   # FeatureContext::iFillInWith()
    And I fill in "Description" with "Description"               # FeatureContext::iFillInWith()
    And I press "Submit"                                         # FeatureContext::iPress()
    Then The meetup should be false                              # FeatureContext::theMeetupShouldBeFalse()

4 scenarios (4 passed)
28 steps (28 passed)
```

Si vous souhaitez modifier les scénarios ou les tests, il suffit de se rendre dans le dossier features