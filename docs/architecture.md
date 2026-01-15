#                                  MVC

#       (M) MODEL --> relation avec base de donnèe
#       (V) VIEW --> TOUT ce que lutilisateur voit 
#       (C) CONTROLLER --> CEST KE CERVEAU QUI ORGANISE TOUT

#  LE CONTROLLER recoit la demande depuis l'utilisateur + questionne le MODEL(M) + ENVOI le resultat au VIEW(V)

# Architecture MVC MaBagnole

## Flux requête :
URL → index.php (Routeur) → Controller → Model → View

## Classes :
- BaseModel (abstrait) ← Categorie, Vehicule, User (héritage)
- BaseController (abstrait) ← CategoriesController, VehiculesController

## Les 4 Principes OOP :

**Encapsulation** : Propriétés privées + getters/setters

**Héritage** : Categorie extends BaseModel

**Abstraction** : BaseModel = classe abstraite

**Polymorphisme** : Même méthode, comportements différents

## Autoload PSR-4

**Autoload** = Chargement automatique des classes sans `require`

**PSR-4** = Namespace = chemin dossier
- `App\Models\Categorie` → `app/models/Categorie.php`

**Natif** = Avec `spl_autoload_register()` (sans Composer)

#                                ROUTAGE

# ROUTAGE = guide
# prendre l'URL que l'utilisateur ecrit et le diriger vers la bonne page (Controller)  example :: si l’utilisateur tape : site.com/login  il se dirige vers site.com/index.php