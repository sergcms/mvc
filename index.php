<?php 

include_once('functions.php');

session_start();

$user = getInstance('User');
$message = getInstance('Message');

$controllers = [
    'login',
    'logout',
    'welcome',
    'message',
];

$controller = $_GET['controller'] ?? 'login';
$controller = in_array($controller, $controllers) 
    ? $controller
    : $controllers[0];

$view = 'login';
$vars = [
    'error' => '',
];

include_once('controllers/' . $controller . '.php');

// Template Engine
$content = file_get_contents(__DIR__ . '/views/' . $view . '.html');
foreach ($vars as $key => $value) {
    $content = str_replace('{{'.$key.'}}', $value, $content);
}
echo $content;
