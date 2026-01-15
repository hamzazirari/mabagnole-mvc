<?php
class Vehicule extends BaseModel {
private int $id;
private string $modele;
private float $prix;
private int $categorie_id;

// TODO : Compléter comme Categorie
 public function __ construct(PDO $pdo,....) {
    parent: :__ construct($pdo);
// à completer
 }
}
?>