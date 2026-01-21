<?php

namespace TaskFlow;

use InvalidArgumentException;
use TypeError;

class TaskController
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * API : POST /tasks
     */
    public function store(array $requestData): array
    {
        try {
            // Validation
            if (!isset($requestData['title'])) {
                throw new InvalidArgumentException("le titre est obligatoire");
            }

            if (!is_string($requestData['title'])) {
                throw new TypeError("le titre doit être une chaîne");
            }

            // Le constructeur Task applique les règles métier
            $task = new Task($requestData['title']);

            // Sauvegarde
            $this->taskRepository->save($task);

            // Réponse API SUCCESS
            return [
                'statut' => 201,
                'data' => [
                    'title' => $task->getTitle(),
                    'is_completed' => $task->isCompleted()
                ]
            ];

        } catch (InvalidArgumentException | TypeError $e) {

            // Réponse API ERROR
            return [
                'statut' => 422,
                'error' => $e->getMessage()
            ];
        }
    }
}
