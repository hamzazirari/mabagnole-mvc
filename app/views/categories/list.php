
<h1>Liste des Catégories et Véhicules</h1>

<?php foreach ($categories as $categorie): ?>
    
    <div class="categorie">
        <h2><?= $categorie->getNom() ?></h2>
        
        <?php if (count($categorie->getVehicules()) > 0): ?>
            <ul>
                <?php foreach ($categorie->getVehicules() as $vehicule): ?>
                    <li>
                        <a href="/vehicules/<?= $vehicule->getId() ?>">
                            <?= $vehicule->getModele() ?> 
                            (<?= $vehicule->getImmatriculation() ?>) 
                            - <?= $vehicule->getPrixJour() ?>€/jour
                            <?php if ($vehicule->getDisponible()): ?>
                                 Disponible
                            <?php else: ?>
                                 Non disponible
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun véhicule dans cette catégorie.</p>
        <?php endif; ?>
    </div>
    
<?php endforeach; ?>