<?php
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
public function loadVehicules(): void { /* TODO */ }

public function save( ): bool {
// TODO : INSERT/UPDATE SQL
return true;
}
public static function find(int $id) {
// TODO : SELECT by ID
}
}
?>