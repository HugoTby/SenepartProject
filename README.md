# Le Projet Senepart

Le projet Senepart est une collaboration entre **Faustin**, **Hugo** et **Mathias** pour la première rotation, la seconde ayant pour membres **Faustin**, **Edouard** et **Joris**, ayant pour but d'offrir une expérience utilisateur optimale dans le domaine de la géolocalisation.

## 🌐 Adresses IP des Machines Virtuelles 

Les machines virtuelles dédiées au projet sont accessibles via les adresses IP suivantes:
- **Site Web** : `192.168.65.68`
- **Base de Données** : `192.168.65.252`

## 🗃 Base de Données : RFID 

Pour accéder à cette base de données, voici les identifiants:
- **Identifiant** : `root`
- **Mot de passe** : `root`

### Structure de la base de données

**RFID**

**Table : utilisateurs**

| Champ     | Type           | Spécificité          |
|-----------|----------------|----------------------|
| id        | int            | Clé primaire         |
| ud        | int            |                      |
| nom       | varchar(30)    |                      |
| prenom    | varchar(300)   |                      |
| classe    | varchar(30)    |                      |
| admin     | tinyint(1)     |                      |
| photo     | tinyint(1)     |                      |
| regime    | tinyint(1)     |                      |
| naissance | tinyint(1)     |                      |


## 📁 Structure du Code

Les fichiers et répertoires sont organisés comme suit:

- **./css**
  - `main.css` : Styles principaux pour les typographies, les éléments de formulaire, les boutons, les alertes de validation, et les éléments spécifiques à la connexion. Inclut également des styles pour différentes tailles d'écran (responsive).
  - `style.css` : Styles de base pour le responsive design et des utilitaires généraux.

- **./js**
    - `main.js` : Scripts généraux du site.
 



### Fichiers Principaux :

- `accueil.php` : Page d'accueil.
- `update_user.php` : Gestion des informations de compte utilisateur.
- `connexion.php` : Page de connexion.
- `inscription.php` : Page d'inscription.
- `readme.md` : Documentation du code (ce fichier).

> **Conseil** : Pour une meilleure compréhension du projet, n'hésitez pas à parcourir chaque fichier et répertoire.
