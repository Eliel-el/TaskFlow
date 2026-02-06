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

test("renvoie 200 à la validation d'une tâche via API", function () {
    $pdo = new PDO('sqlite::memory:');
    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    // Create a task
    $taskController->store(['title' => "Tâche à valider"]);
    $tasks = $taskRepository->getAll();
    $taskId = $tasks[0]['id'];

    $response = $taskController->update($taskId, ['is_completed' => true]);

    expect($response['statut'])->toBe(200);
    expect($response['data']['is_completed'])->toBe(true);

    // Verify in DB
    $updatedTask = $taskRepository->findById($taskId);
    expect($updatedTask->isCompleted())->toBe(true);
});

test("renvoie 204 à la suppression d'une tâche via API", function () {
    $pdo = new PDO('sqlite::memory:');
    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    $taskController->store(['title' => "Tâche à supprimer"]);
    $tasks = $taskRepository->getAll();
    $taskId = $tasks[0]['id'];

    $response = $taskController->delete($taskId);

    expect($response['statut'])->toBe(204);
    expect($taskRepository->findById($taskId))->toBeNull();
});

test("renvoie 404 si on tente de valider une tâche inexistante", function () {
    $pdo = new PDO('sqlite::memory:');
    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    $response = $taskController->update(999, ['is_completed' => true]);

    expect($response['statut'])->toBe(404);
});

test("renvoie 404 si on tente de supprimer une tâche inexistante", function () {
    $pdo = new PDO('sqlite::memory:');
    $taskRepository = new TaskRepository($pdo);
    $taskController = new TaskController($taskRepository);

    $response = $taskController->delete(999);

    expect($response['statut'])->toBe(404);
});
