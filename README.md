# tailwind cc
-npm install -D @tailwindcss/forms

# font aweson
-<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

# Mailtrop
- 2af7a5856b80e9f1e8fc29c4d8229573

# controller pour la gestion des LINK
 php artisan make:controller  Auth/RegisterController

# Listing
 php artisan make:model Listing -a    

# pour afficher les differents routes 

   php artisan route:list
    php artisan migrate:fresh
    php artisan db:seed
# pour lier les images du public stroage dans le dossier public
   -php artisan storage:link

# Lodash
-une library pour la recherche en fin deviter les rebons 
-npm i --save lodash

# recherche
  -la recherche concer les class listing.php ListingController:backend , home.vue card.vue:frontend
# pour creer unn middleware particulier
 -php artisan make:middleware NotSuspended(nom)

# COntroll affichage
pour controler l'affiche on se rend dans policies

# pour valider la creation automatique des attributs de table et validate
  -on touche le dossier factories et databaseSeeder.php
  - php artsian migrate:fresh puis php artisan db:seed

# Admin role
  -creer un controller admin
  -definir les routes de l'admin dans web.php
  -creer  le dossiee admin
  -creer 