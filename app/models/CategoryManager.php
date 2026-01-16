<?php
class CategoryManager {
    private PDO $pdo;

    
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAllWithVehicules(): array {
        $categories = [];

        $sql = 'SELECT * FROM categories';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categorie = new Categorie(
                $this->pdo,
                $row['id_categorie'],
                $row['nom']
            );

            $categorie->loadVehicules();

            $categories[] = $categorie;
        }

        return $categories;
    }
}
?>