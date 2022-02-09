#Site Web Japan Impact 11 (2019)

Avec le nouveau site designé par Kim, quelques informations s'imposent à: comment écrire un article et l'afficher sur les différentes page du site, comment ajouter une image, comment créer les zones du programme, etc.


##Settings.php

Cette page très spéciale contient les différentes informations qui permettent de gérer les informations sur JI, telles que les dates de l'évènement (affichés sur la page principale), les catégories des activités, certaines traductions FR/EN, et l'image du header (l'affiche). Il peut arriver que des informations doivent être changées (en l'occurence les dates seront à changer chaque année). Il n'est pas nécessaire de savoir coder ici, mais simplement de remplacer les différentes données ! Le code est donc particulièrement bien commenté pour que le pôle communication puisse le changer d'eux-mêmes, mais si jamais il faut demander au responsable informatique un peu d'aide.

##Pages

Les pages ont un titre automatique (pas besoin de l'écrire dans l'article).

###Pages spéciales - "catégories"

Certaines "pages" réunissent différents articles (concerts, projections,...). Celles-ci sont basées sur les catégories correspondantes, et n'ont pas besoin d'être modifiées. Ces pages sont créées directement via le menu, en ajoutant un onglet "catégorie".

## Articles

### Introduction: Ajouter un champ personnalisé

Les champs personnalisés sont des données propres aux articles. Elles sont particulièrement pratique car elles peuvent facilement s'emboîter dans le code php du site, et donc d'avoir des mises en page automatique. C'est notamment le cas pour les images principales, et l'emplacement dans le planning.

Pour ajouter un champ personnalisé, il faut premièrement afficher la zone "Champs Personnalisés". Pour cela ouvrir, commencez à écrire un article, et ouvrez l'onglet (tout en haut de l'écran) *Options de l'écran*, puis cocher "Champs personnalisés".
Puis, sous la zone de contenu de l'article, vous trouverez une zone "Champs personnalisés". Vous y trouverez de nombreux choix de nom, et pourrez même en ajouter de nouveau.   

Pour plus d'informations: https://codex.wordpress.org/Custom_Fields

### Images
Pour ajouter une image d'article (image principale), ajoutez un champ personnalisé "img" avec le lien de l'image. L'article peut ensuite contenir des images secondaires (à ajouter en html avec une balise <img>).

### Activités JI
Les articles décrivant les activités de JI apparaissent dans la page programme et dans le planning si les conditions suivantes sont remplies:
- Contient une date/lieu via les différents champs personnalisés (respectez la case !) (correspond aux données définies dans settings.php):
  - *class*: couleur de zone (green/yellow/pink/orange/red/blue/purple)
  - *room*: salle (ex: matsuri, aki)
  - *day*: jour (sa/di)
  - *from*: depuis quelle heure (ex: 10:30, 11:00)
  - *to*: jusqu'à quelle heure (ex: 10:30, 11:00)
