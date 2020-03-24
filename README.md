# ProjetPHP - TROUVER UN NOM
Tout est dans le titre quoi.

# Tâches à accomplir

SUPINFO vous demande de créer un site où il sera possible de créer vos "TODO list" privée et de les partager à vos amis. À la fin du projet, vous devrez faire une présentation à votre correcteur.

## Design

Vous êtes libres d'utiliser les couleurs de votre choix mais le design du site reste une partie importante du projet. Le site devra avoir un thème clair et un autre sombre dont il sera possible de passer de l'un à l'autre.

## Inscription, connexion, déconnexion

Pour que l'utilisateur soit capable de créer ses "TODO lists", vous devrez mettre en place un système d'inscription, de connexion et de déconnexion. Pour créer un compte, l'utilisateur devra fournir un nom d'utilisateur, une adresse e-mail et un mot de passe. Le nom d'utilisateur et l'email doivent être unique. Le projet sera accompagné d'une base de données MySQL.

## Page d'accueil

Une fois que l'utilisateur est connecté au site, il sera redirigé sur la page d'accueil. Elle contiendra les notifications de partage et les "TODO lists" de l'utilisateur ainsi que celles partagées avec lui. Vous devrait être capable d'effectuer les actions suivantes:

 - Accepter ou refuser une demande de partage de "TODO list".
 - Créer une nouvelle "TODO list".
 - Supprimer une "TODO list".
 - Cliquer sur une "TODO list" existante pour la modifier.

Vous êtes libres quant à l'affichage de celles-ci.

## Page des "TODO lists"

Cette page est la plus importante du site. Elle va permettre la gestion des "TODO lists" avec ces différents éléments:

 - La "TODO list" devra contenir deux partie: "Tâche en cours" et "Tâche complétée".
 - La possibilité d'afficher toutes les tâches ou seulement celle en cours ou terminées.
 - Ajouter et retirer un élément de la "TODO list" sans avoir besoin de recharger la page.
 - Passer le statut d'une tâche de "en cours" à "complétée".
 - Un bouton pour passer le statut de toutes les tâches à "en cours".
 - Un bouton pour passer le statut de toutes les tâches à "complétée".

Il y aura aussi une gestion des amis. Vous devrez être capable de partager une "TODO list" avec une personne en utilisant leur nom d'utilisateur ou leur adresse e-mail. Ils recevront alors une notification sur leur page d'accueil ainsi qu'un e-mail.
Quand vous ajouterez un ami à votre "TODO list", vous devrez pouvoir lui attribuer le droit de modifier ou seulement la lecture. Vous devrez être capable de supprimer un ami ajouté à une "TODO list".

## Tests unitaires

Vous devrez utiliser la bibliothèque PHPUnit pour effectuer des tests d'unités sur votre application. **Vous devez couvrir au moins 50% du code avec cette bibliothèque.**


# Notation

| Tâche | Points de la tâche | Points du groupe |
|--|--|--|
| Inscription, connexion et déconnexion | 3 pts | 3 pt |
| Création/suppression d'une "TODO list" | 2 pt | 0 pt |
| Affichage des "TODO lists" | 1 pt | 0.5 pt |
| Changer le statut d'une tâche | 1 pt | 0.5 pt |
| Boutons "cocher / décocher tout" | 1 pt | 0 pt |
| Trouver un utilisateur avec son nom/e-mail | 1 pt | 0 pt |
| Envoi d'un mail d'invitation | 1 pt | 0 pt |
| Affichage de la notification | 1 pt | 0 pt |
| Affichage des listes partagés et modification des droits | 2 pts | 0 pt |
| Supprimer un ami | 1 pt | 0 pt
| Création des tests d'unités | 3 pts | 0 pt |
| Design d'un thème clair et sombre | 3 pts | 0 pt |
| Total | 20 pts | 4 pt |

## Présentation au correcteur

Vous aurez un passage de 10 à 15 minutes de présentation du projet. Vous pouvez utiliser n'importe quel moyen pour y parvenir.

## Arborescence du dossier

 - ProjetPHP
	 - assets
		 - css
		 - js
		 - images
	 - classes
	 - config
	 - php
	 - views
