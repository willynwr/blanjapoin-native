<?php
// Aktifkan error reporting biar gampang debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ Definisikan path root project
define('BASE_PATH', dirname(__DIR__));

// 2️⃣ Include routes (rute utama)
require BASE_PATH . '/routes/web.php';

// 3️⃣ Tangkap request (misal: ?page=welcome)
$page = $_GET['page'] ?? 'welcome';

// 4️⃣ Jalankan routing berdasarkan page
if (isset($routes[$page])) {
    $target = $routes[$page];
    
    // Kalau controller didefinisikan
    if (isset($target['controller'])) {
        require BASE_PATH . '/controllers/' . $target['controller'] . '.php';
        $controllerClass = $target['controller'];
        $controller = new $controllerClass();
        $controller->{$target['method']}();
    } 
    // Kalau cuma view (tanpa controller)
    elseif (isset($target['view'])) {
        include BASE_PATH . '/views/' . $target['view'] . '.php';
    } 
    else {
        echo "Rute tidak valid.";
    }
} else {
    echo "404 - Halaman tidak ditemukan";
}
