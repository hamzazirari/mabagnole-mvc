
<h1>Détails du Véhicule</h1>

<div class="vehicule-detail">
    <h2><?= $vehicule->getModele() ?></h2>
    
    <p><strong>Immatriculation :</strong> <?= $vehicule->getImmatriculation() ?></p>
    
    <p><strong>Prix par jour :</strong> <?= $vehicule->getPrixJour() ?>€</p>
    
    <p><strong>Statut :</strong> 
        <?php if ($vehicule->getDisponible()): ?>
            <span style="color: green;"> Disponible</span>
        <?php else: ?>
            <span style="color: red;"> Non disponible</span>
        <?php endif; ?>
    </p>
    
    <p><strong>Catégorie ID :</strong> <?= $vehicule->getCategorieId() ?></p>
    
    <br>
    <a href="/categories">← Retour à la liste</a>
</div>