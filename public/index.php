<?php

use TaskFlow\TaskController;
use TaskFlow\TaskRepository;
require __DIR__."/../vendor/autoload.php";

$pdo = new PDO('sqlite:'.__DIR__."/../database.sqlite");
$tasksRepository = new TaskRepository($pdo);

$taskController = new TaskController($tasksRepository);

$methode = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

if ($methode === 'GET' && ($path === '/' || $path === '/index.php')) {
    require __DIR__ . '/app.html';
    exit;
}

header('Content-Type: application/json');

if ($methode === 'GET' and $path === '/api/tasks') {
    $response = $taskController->index();

    http_response_code($response['statut']);
   
    echo json_encode($response);
    exit;
}
if ($methode === 'POST' and $path === '/api/tasks') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true) ?? [];

    $response = $taskController->store($data);

    http_response_code($response['statut']);
    echo json_encode($response);
    exit;
}

if ($methode === 'PUT' && preg_match('#^/api/tasks/(\d+)$#', $path, $matches)) {
    $id = (int)$matches[1];
    $json = file_get_contents("php://input");
    $data = json_decode($json, true) ?? [];

    $response = $taskController->update($id, $data);

    http_response_code($response['statut']);
    echo json_encode($response);
    exit;
}

if ($methode === 'DELETE' && preg_match('#^/api/tasks/(\d+)$#', $path, $matches)) {
    $id = (int)$matches[1];

    $response = $taskController->delete($id);

    http_response_code($response['statut']);
    exit;
}

http_response_code(404);
echo json_encode(["error" => "Route introuvable"]);
exit;