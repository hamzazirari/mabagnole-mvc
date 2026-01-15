<?php
session_start();

if(!isset($_SESSION['id_client'])){
    header('Location: connexion.php');
    exit();
}

require_once 'classes/Database.php';

$db = new Database();
$pdo = $db->getPdo();

$stmt = $pdo->query("SELECT vehicules.*,categories.nom AS nom_categorie FROM vehicules INNER JOIN categories ON vehicules.categorie_id = categories.id_categorie WHERE vehicules.disponible = 1");

$vehicules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules Disponibles - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
    
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                </svg>
                <h1 class="text-2xl font-bold text-blue-600">MaBagnole</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">
                    Bienvenue, <strong><?php echo $_SESSION['nom']; ?></strong>
                </span>
                <a href="deconnexion.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                    Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Véhicules Disponibles</h2>
            <p class="text-gray-600 text-lg">Découvrez notre large sélection de véhicules à louer</p>
        </div>

        <!-- Si aucun véhicule -->
        <?php if (empty($vehicules)): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-6 py-4 rounded-lg text-center">
                <p class="text-lg">Aucun véhicule disponible pour le moment.</p>
            </div>
        <?php else: ?>

        <!-- Grille de véhicules -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <?php foreach ($vehicules as $vehicule): ?>
            <!-- Card Véhicule -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                
                <!-- Image placeholder -->
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                    </svg>
                </div>

                <!-- Contenu -->
                <div class="p-6">
                    
                    <!-- Badge Catégorie -->
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-semibold mb-3">
                        <?php echo htmlspecialchars($vehicule['nom_categorie']); ?>
                    </span>

                    <!-- Modèle -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        <?php echo htmlspecialchars($vehicule['modele']); ?>
                    </h3>

                    <!-- Immatriculation -->
                    <p class="text-gray-600 mb-1">
                        <span class="font-semibold">Immatriculation:</span> 
                        <?php echo htmlspecialchars($vehicule['immatriculation']); ?>
                    </p>

                    <!-- Prix -->
                    <p class="text-3xl font-bold text-blue-600 mb-4">
                        <?php echo number_format($vehicule['prix_jour'], 2); ?> €
                        <span class="text-sm text-gray-500 font-normal">/jour</span>
                    </p>

                    <!-- Disponibilité -->
                    <div class="flex items-center mb-4">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-green-600 font-semibold">Disponible</span>
                    </div>

                    <!-- Bouton Détails -->
                    <a href="details_vehicule.php?id=<?php echo $vehicule['id_vehicule']; ?>" 
                       class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 transform hover:scale-105">
                        Voir les détails
                    </a>
                </div>

            </div>
            <?php endforeach; ?>

        </div>

        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">© 2025 MaBagnole - Location de véhicules</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="text-gray-400 hover:text-white transition">À propos</a>
                <a href="#" class="text-gray-400 hover:text-white transition">Contact</a>
                <a href="#" class="text-gray-400 hover:text-white transition">CGU</a>
            </div>
        </div>
    </footer>

</body>
</html>