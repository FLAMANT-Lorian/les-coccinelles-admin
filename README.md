# ASBL Les Coccinelles Morhet – Intranet

Intranet permettant la gestion de l’ASBL Les Coccinelles de Morhet

## Prérequis

---

- PHP 8.4 ou supérieur
- Composer 2.x
- MySQL 8.0 ou supérieur
- Node.js 22.20.0 ou supérieur
- Npm 10.9.3 ou supérieur

## Installation

---

```bash
# 1. Cloner le projet
git clone *url-du-repo-github*
cd les-coccinelles-admin

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances JS
npm install

# 4. Créer le fichier d'environnement à partir de l'exemple
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
# DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 7. Lancer les migrations et insérer des données fictives
php artisan migrate --seed

# 8. Créer le lien symbolique pour les images statiques
php artisan storage:link

# 9. Lancer le serveur
composer run dev

# 10. Lancer les queues dans des terminaux séparés
php artisan queue:work --queue=avatar
php artisan queue:work --queue=document
```

## Technologies utilisées

---

### Back-end

- **Laravel 13** : Framework PHP principal
- **Livewire 4.2** : Interfaces dynamiques
- **MySQL 8.0** : Base de données
- **Redis** : Utilisé comme système de fille d’attente pour exécuter les jobs en arrière plan
- **PestPHP** : Framework de test PHP
- **Stockage** : AWS S3 storage

### Front-end

- **Blade** : Moteur de templates de Laravel
- **Alpine.js** : Interactivité de l’interface
- **Tailwind CSS** : Style de l’interface

---

## Cahier des charges

**1. Contexte de l’application**

L’ASBL **“Les Coccinelles”** est située à Morhet, un village dans la province du Luxembourg. Celle-ci met à disposition des habitants et personnes extérieures une salle à louer, et y organise régulièrement des événements afin de faire vivre le village. Des activités sont également organisées hors de la salle.

À l’heure actuelle, l’ASBL ne possède pas de logiciel pour être gérée. Afin de leur faire gagner du temps et de réduire la charge de travail des différents membres, je souhaite développer une application de gestion pour l’ASBL afin qu’il puisse y gérer :

- La gestion de la salle du village
- La gestion des différents membres
- Les réservations de la salle
- Les messages de contact
- L’organisation des réunions
- L’organisation des événements

De plus, un site public sera développé afin de promouvoir leur image et mettre directement à disposition de l’utilisateur des informations concernant l’ASBL. Les différentes fonctionnalités disponible dans ce site **WordPress** seront la gestion:

- La création d’articles
- La création d’événements
- La gestion des contenus (Textes et images)

L’objectif est de fournir à l’ASBL un produit moderne et simple d’utilisation pour gérer au mieux tous les points énoncés ci-dessus.

**2. Personas et parcours utilisateurs**

**Alain – Président de l’ASBL**

**→ Rôle** : Président de l’ASBL

**🗂️ Parcours utilisateur 1 – Réservation de la salle**

Samedi matin, Adrien reçoit une notification comme quoi **Claude** voudrait réserver la salle de l’ASBL via un message envoyé depuis le site public de l’ASBL. Il se rend alors sur son interface d’administration, se rend dans le section lié au message et commence à lire le message. Après avoir lu le message, il vérifie si les dates sont disponibles et se rend sur la page de création d’une réservation.

Un fois cette sur cette page, il clique sur le bouton “Créer une nouvelle réservation”, il indique ensuite les dates de début et fin de la réservation ainsi que les informations sur **Claude**. Il se rend ensuite dans la partie liée au détail technique de la salle, il choisit le type de réservation parmi les types proposés et valide la réservation. Lors de la création de la fiche, un contrat à été généré en fonction du type de la réservation, il peut le visualiser et/ou le télécharger après la création.

Une fois la fiche créée, un email est envoyé à **Claude** pour confirmer sa réservation.

---

**🗂️ Parcours utilisateur 2 – Erreur dans la fiche**

Deux jours plus tard, Adrien veut télécharger le contrat de location pour pouvoir le faire signer à **Claude.** Malheureusement, il se rend compte qu’il s’est trompé dans le type d’activité et en plus, il n’existe pas dans les types disponibles. Il clique alors sur le lien qui lui permet d’ajouter des types à la volée, il renseigne alors un nouveau type “Activités sportives” et lui attribue les informations nécessaires (Prix sans carte de membre, prix avec carte de membre), puis valide le nouveau type. Il peut ensuit régénérer le contrat avec les nouvelles informations.

Le nouveau type ajouté est visible et modifiable dans les différents onglets disponibles pour les gérer les réservations.

---

**🗂️ Parcours utilisateur 3 – Encodage des index**

Avant que la réservation de Claude ne commence, Adrien à pris note des relevés des compteurs d’électricité et de mazout. Adrien a peur de perdre ces données car elles sont importantes pour la génération du contrat. Il ouvre donc l’application web sur son téléphone et encode les différents index sur la page de la réservation de Claude.

Lorsque la réservation de Claude arrive à terme, Adrien prend quelques minutes pour encoder les index pour éviter que la situation précédente ne se reproduise.

---

**🗂️ Parcours utilisateur 4 – Création d’un profil membre normal**

Après avoir été satisfait par sa réservation, **Claude** décide de rejoindre l’ASBL pour y donner de son temps, il demande à Adrien qui accepte avec grand plaisir. Une fois rentré du travail, Adrien se rend sur l’interface d’administration, va dans la rubrique lié aux membres, et commence à créer un nouveau profil membre. Il remplit les informations et choisi son rôle dans l’ASBL. Une fois la création terminée, **Claude** reçoit un mail avec ses identifiants, accède à son compte et peut voir certaines informations sur l’administration.

---

**🗂️ Parcours utilisateur 5 – Départ de Camille**

Après 6 années passées dans l’ASBL, Camille décide de tirer sa révérence de de quitter cette belle aventure. Elle prévient Adrien qui va changer le statut de Camille en “Ancien membre” dans l’application. Elle y garde toujours le profil de Camille au cas où elle décide de revenir un jour.

Une fois que le statut d’un compte bénévole passe en “Ancien membre”, celui-ci ne peut plus accéder à l’espace d’administration

---

**Vic – Secrétaire du comité**

**→ Rôle** : Secrétaire de l’ASBL

**🗂️ Parcours utilisateur 1 – Création d’une réunion**

En tant que secrétaire du comité de l’ASBL, Léa a le droit de planifier des réunions avec les membres de l’ASBL ( Tout rôle confondu ). Et justement, elle aimerait planifié une réunion pour parler de leur prochains événements.

Elle se rend donc sur la page de création d’une réunion, y inscrit le sujet, la date, l’heure, l’endroit et sélectionne les participants parmi les membres de l’ASBL, elle valide la création de la réunion.

Une fois la réunion créée, elle décide d’y ajouter des documents pour préparer la future réunion en avance, une section dédiée a cette fonctionnalité est prévue dans l’application.

---

**🗂️ Parcours utilisateur 2 – En pleine réunion**

Lors de la réunion programmée par Léa, beaucoup de propositions ont été faites pour le futur événement. Une fois rentrée chez elle, elle remet tout au propre dans un nouveau document, et le rend disponible sur l’application. Tous les membres, peu importe le rôle, y ont accès mais seul le comité peut modifier les informations de la réunion.

Léa semble satisfaite du compte rendu de la réunion et décide de créer l’événement.

---

**🗂️ Parcours utilisateur 3 – Un nouvel événement**

Après cette longue réunion, Léa créer l’événement via une page dédié à cette action. Il y ajoute toutes les informations nécéssaires à la création de l’événement.

Un fois l’événement créé, Léa ajoute dans la liste des tâches à réaliser, les différentes choses à ne pas oublier lors de la préparation en amont de l’événement.

Après quelques semaines, de nombreux papiers se sont accumulés dans le bureau de Léa, elle décide donc de numériser tous les papiers et de les introduire dans le site dans la section dédiée à cet effet. Elle peut même y créer des dossiers pour mieux structurer tous ses papiers.

---

**Alex – Membre du comité**

**→ Rôle** : Gestionnaire du site public

**🗂️ Parcours utilisateur 1 – Changement d’adresse**

L’annonce vient de tomber, la commune à décidé de changer le nom de la rue où se trouve l’asbl. Alex se rend alors dans les paramètres du site public (WordPress) et modifie l’adresse. Une fois la modification effectuée, elle est directement répercutée dans le site public. Il en profite par la même occasion pour mettre à jour le numéro de téléphone.

---

**🗂️ Parcours utilisateur 2 – Compte rendu de la randonnée VTT annuelle**

Tous les ans, l’asbl organise une randonnée VTT, cette année fut un succès ! Alex décide alors d’écrire un petit article sur cette édition afin de la partager à un grand nombre de personnes. Il se rend alors dans la page spécifique à la création d’articles et se met à rédiger. Il y ajoute plusieurs paragraphes, photos, etc.

---

**Flora – Simple utilisateur d’internet**

**→ Rôle** : Simple visiteur

**🗂️ Parcours utilisateur 1 – Réservation d’une salle**

Flora cherche une salle pour l’anniversaire de son petit garçon. Son mari lui avait partagé le lien de cette salle. Elle y regarde donc, lit les informations et fait une demande de réservation via le formulaire dans le site public. L’administrateur reçoit la demande dans son administration et donne des nouvelles à Flora par la suite.

---

**🗂️ Parcours utilisateur 2 – Recherche d’une activité**

Ce week-end, Flora a envie de bouger, elle regarde les activités que propose l’asbl. Elle tombe sur la randonnée VTT annuelle, elle décide donc d’y aller. Elle regarde les différentes distances proposées car elle compte y aller avec son fils mais celui-ci n’est pas très sportif et donc pas capable de réaliser une longue distance. Après avoir trouvé la distance qu’il lui convient, elle la partage a son mari pour voir si cela lui convient.

---

**3. Fonctionnalités**

**✉️ Envoi de notifications – mail**

- Lorsqu’un événement approche
- Lorsqu’une réservation approche
    - Au locataire
- Lorsqu’une réunion approche

**🗓️ Réservation de la salle**

- Création d’une fiche de réservation
- Génération d’un contrat en fonction du type de la réservation

---

**🗓️ Calendrier**

- Informations sur les prochaines réunions, événements, réservations

---

**🧩 Gestion des activités – événements**

- Création, suppression, modification de l’événement
- Liste des choses importantes à réaliser
- Classement de fichiers selon des dossiers

---

**🤵‍♂️ Gestion des membres**

- Création, suppression, modification de profil membre
- Gestion des différents rôles

---

**📆 Gestion des réunions**

- Création, suppression, modification d’une réunion
- Ajout du rapport de réunion (PDF ou autre format de document texte)
