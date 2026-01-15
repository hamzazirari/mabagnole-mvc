<?php

namespace App\Models;
use PDO;

class Categorie extends BaseModel {
private int $id;
private string $nom;
private array $vehicules = [];

public function _construct(PDO $pdo, int $id = 0, string $nom = '' ) {
parent ::_ construct($pdo);
$this->id = $id;
$this->nom = $nom;
}
// GETTERS (Encapsulation)
public function getId( ): int { return $this->id; }
public function getNom( ): string { return $this->nom; }
public function getVehicules(): array { return $this->vehicules; }

// À CODER : loadVehicules( ), save( )
public function loadVehicules(): void { 
    $sql = 'SELECT * FROM vehicules WHERE categorie_id = :id';
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $this->id]);

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $vehicule = new Vehicule(
            $this->pdo,
            $row['id_vehicule'],
            $row['modele'],
            $row['immatriculation'],
            $row['prix_jour'],
            $row['categorie_id'],
            $row['disponible']
        );
        $this->vehicules[] = $vehicule;
    }

 }

public function save(): bool {
    if($this->id == 0){
        // Creer nouvelle cat
        $sql = 'INSERT INTO categories (nom) VALUES (:nom)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nom' => $this->nom]);
        $this->id = $this->pdo->lastInsertId();
    }
    else if ($this->id > 0){
        // Modifier catt
        $sql = 'UPDATE categories SET nom = :nom WHERE id_categorie = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nom' => $this->nom,'id' => $this->id
        ]);
    }
    return true;
}
public static function find(int $id, PDO $pdo) {
    $sql = 'SELECT * FROM categories WHERE id_categorie = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]); 

    if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categorie = new Categorie(
            $pdo,  
            $result['id_categorie'],  
            $result['nom']
        );
        return $categorie;  
    }
    else{
        return null;
    }
}
}

?>