<?php

use TaskFlow\TaskController;
use TaskFlow\TaskRepository;
require __DIR__."/../vendor/autoload.php";

$pdo = new PDO('sqlite:'.__DIR__."/../database.sqlite");
$tasksRepository = new TaskRepository($pdo);

$taskController = new TaskController($tasksRepository);

$methode = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];
if ($methode === 'GET' and $url === '/api/tasks') {
    $response = $taskController->index();

    http_response_code($response['statut']);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
if ($methode === 'POST' and $url === '/api/tasks') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true) ?? [];

    $response = $taskController->store($data);

    http_response_code($response['statut']);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route introuvable"]);
    exit;
}