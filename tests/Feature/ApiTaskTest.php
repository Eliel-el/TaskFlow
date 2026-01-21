<?php

use TaskFlow\TaskController;
use TaskFlow\TaskRepository;

test("renvoie 201 à la création d'une tâche via API", function () {

    $pdo = new PDO('sqlite::memory:');
    

    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    $payload = ['title' => "Test API"];
    $reponse = $taskController->store($payload);

    expect($reponse['statut'])->toBe(201);
    expect($reponse['data']['title'])->toBe("Test API");
    expect($taskRepository->getAll())->toHaveCount(1);
});

test("renvoie 422 si la tâche à créer a un titre trop court", function () {

    $pdo = new PDO('sqlite::memory:');
    

    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    $payload = ['title' => "ABC"];
    $reponse = $taskController->store($payload);

    expect($reponse['statut'])->toBe(422);
    expect($reponse['error'])->toContain("entre 5 et 255 caractères");
    expect($taskRepository->getAll())->toHaveCount(0);
});
