<?php

use TaskFlow\Task;
use TaskFlow\TaskRepository;

beforeEach(function () {

    $this->pdo = new PDO('sqlite::memory:');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $this->taskRepository = new TaskRepository($this->pdo);
});

describe("F.1.1 : L'utilisateur doit créer une nouvelle tâche", function () {

    it('Cas de base 1 : crée une nouvelle tâche dans la bdd', function () {

        $task = new Task("Test d'integration");
        $this->taskRepository->save($task);

        $tasks = $this->taskRepository->getAll();

        expect($tasks)->toHaveCount(1);
        expect($tasks[0]['title'])->toBe("Test d'integration");
        expect($tasks[0]['is_completed'])->toBe(0);
    });
});

describe("F.1.2 : Récupération de toutes les tâches", function () {

    test("cas de base : renvoie les 3 tâches enregistrées dans la bdd", function () {

        $this->taskRepository->save(new Task("Tâche 1"));
        $this->taskRepository->save(new Task("Tâche 2"));
        $this->taskRepository->save(new Task("Tâche 3"));

        $tasks = $this->taskRepository->getAll();

        expect($tasks)->toHaveCount(3);
        expect($tasks[0]['title'])->toBe("Tâche 1");
        expect($tasks[1]['title'])->toBe("Tâche 2");
        expect($tasks[2]['title'])->toBe("Tâche 3");
    });
});
