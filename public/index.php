<?php

use TaskFlow\TaskController;
use TaskFlow\TaskRepository;
require __DIR__."/../vendor/autoload.php";

$pdo = new PDO('sqlite:'.__DIR__."/../database.sqlite");
$tasksRepsositotry = new TaskRepository($pdo);
$taskController = new TaskController($tasksController);

$methode = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];

if ($methode === 'POST' and $url === '/apip/tasks') {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true) ?? [];

    $response = $taskController->store($data);

    http_response_code($response['status']);
    header('Content-Type: appliction/json');
    echo json_encode($response);
    exit;
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route introuvable"]);
    exit;
}