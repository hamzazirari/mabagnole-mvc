<?php
session_start();
require_once 'classes/Database.php';
$erreur = '';

if(isset($_POST['connexion'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new DATAbase();
    $pdo = $db->getPdo();

    $stmt = $pdo->prepare("SELECT *FROM clients WHERE email = ?");
    $stmt->execute([$email]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if($client){
        if(password_verify($password, $client['motpasse_hash'])){
            $_SESSION['id_client'] = $client['id_client'];
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['email'] = $client['email'];

            header('Location: vehicules.php');
            exit();
        }else{
            $erreur = "Mot de passe incorrect";
        }
    }else{
        $erreur = "Email introuvable";
    }
}
?>


<!-- TEST TEST 
 INSERT INTO clients (nom, email, motpasse_hash) 
VALUES ('Test User', 'test@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
  Email : test@test.com
Mot de passe : password
-->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - MaBagnole</title>
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
            <div class="space-x-4">
                <a href="index.php" class="text-gray-600 hover:text-blue-600 transition">Accueil</a>
                <a href="connexion.php" class="text-blue-600 font-semibold">Connexion</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto">
            
            <!-- Card -->
            <div class="bg-white rounded-lg shadow-xl p-8">
                
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Connexion</h2>
                    <p class="text-gray-600">Accédez à votre espace de location</p>
                </div>

            

                <!-- Formulaire -->
                <form method="POST" action="connexion.php" class="space-y-6">
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="votre@email.com"
                        >
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Mot de passe
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="••••••••"
                        >
                    </div>

                    <!-- Bouton -->
                    <button 
                        type="submit"
                        name="connexion"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 transform hover:scale-105"
                    >
                        Se connecter
                    </button>

                </form>

                <!-- Lien inscription -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Pas encore de compte ? 
                        <a href="inscription.php" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Créer un compte
                        </a>
                    </p>
                </div>

            </div>

        </div>
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