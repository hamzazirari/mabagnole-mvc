<?php
class Vehicule extends BaseModel {
    private int $id;
    private string $modele;
    private string $immatriculation;
    private float $prix_jour;
    private int $categorie_id;
    private bool $disponible;

    // CONSTRUCTEUR
    public function __construct(PDO $pdo, int $id, string $modele, string $immatriculation, float $prix_jour, int $categorie_id, bool $disponible) {
        parent::__construct($pdo);
        $this->id = $id;
        $this->modele = $modele;
        $this->immatriculation = $immatriculation;
        $this->prix_jour = $prix_jour;
        $this->categorie_id = $categorie_id;
        $this->disponible = $disponible;
    }

    // GETTERS
    public function getId(): int {
        return $this->id;
    }

    public function getModele(): string {
        return $this->modele;
    }

    public function getImmatriculation(): string {
        return $this->immatriculation;
    }

    public function getPrixJour(): float {
        return $this->prix_jour;
    }

    public function getCategorieId(): int {
        return $this->categorie_id;
    }

    public function getDisponible(): bool {
        return $this->disponible;
    }

    public function save(): bool {
        return true;
    }

    public static function find(int $id) {
        return null;
    }
}
?>