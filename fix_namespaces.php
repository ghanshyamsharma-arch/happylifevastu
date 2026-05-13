cat > fix_namespaces.php << 'EOF'
<?php
// Fix all namespace issues
echo "Fixing namespaces...\n";

// 1. Fix Services files
$servicesFiles = ['app/Services/ZegoTokenGenerator.php', 'app/Services/ZegoCloudService.php'];
foreach ($servicesFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\services;/', 'namespace App\\\\Services;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

// 2. Fix Frontend/Astrologer controllers
$frontendDir = 'app/Http/Controllers/Frontend/Astrologer/';
if (is_dir($frontendDir)) {
    $files = glob($frontendDir . '*.php');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\Http\\\\Controllers\\\\frontend\\\\Astrologer;/', 'namespace App\\\\Http\\\\Controllers\\\\Frontend\\\\Astrologer;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

// 3. Fix Admin controllers
$adminFiles = [
    'app/Http/Controllers/Admin/ColorSchemeController.php',
    'app/Http/Controllers/Admin/DarkModeController.php',
    'app/Http/Controllers/Admin/Astrologer.php'
];
foreach ($adminFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\Http\\\\Controllers;/', 'namespace App\\\\Http\\\\Controllers\\\\Admin;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

// 4. Fix API controllers
$apiFiles = [
    'app/Http/Controllers/API/Astrologer/WalletController.php',
    'app/Http/Controllers/API/Astrologer/UserReviewController.php'
];
foreach ($apiFiles as $file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\Http\\\\Controllers\\\\API\\\\API\\\\Astrologer;/', 'namespace App\\\\Http\\\\Controllers\\\\API\\\\Astrologer;', $content);
        $content = preg_replace('/namespace\s+App\\\\Http\\\\Controllers\\\\API\\\\User;/', 'namespace App\\\\Http\\\\Controllers\\\\API\\\\Astrologer;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

// 5. Fix Paygate Components
$paygateComponentsDir = 'app/Paygate/Components/Payment/';
if (is_dir($paygateComponentsDir)) {
    $files = glob($paygateComponentsDir . '*.php');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\Components\\\\Payment;/', 'namespace App\\\\Paygate\\\\Components\\\\Payment;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

// 6. Fix Paygate Service
$paygateServiceDir = 'app/Paygate/Service/';
if (is_dir($paygateServiceDir)) {
    $files = glob($paygateServiceDir . '*.php');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $content = preg_replace('/namespace\s+App\\\\Service;/', 'namespace App\\\\Paygate\\\\Service;', $content);
        file_put_contents($file, $content);
        echo "Fixed: $file\n";
    }
}

echo "\nAll namespaces fixed! Now run: php composer.phar dump-autoload\n";
EOF