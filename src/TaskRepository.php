<?php
    namespace TaskFlow;
    use PDO;
    class TaskRepository
    {
        protected PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS tasks (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                is_completed INTEGER NOT NULL DEFAULT 0
            )");
        }

        public function save(Task $task): void {
            if ($task->getId() === null) {
                $statement = $this->pdo->prepare("INSERT INTO tasks (title, is_completed) VALUES (:title, :is_completed)");
                $statement->execute([
                    'title' => $task->getTitle(),
                    'is_completed' => $task->isCompleted() ? 1 : 0
                ]);
                $task->setId((int)$this->pdo->lastInsertId());
            } else {
                $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title, is_completed = :is_completed WHERE id = :id");
                $stmt->execute([
                    'id' => $task->getId(),
                    'title' => $task->getTitle(),
                    'is_completed' => $task->isCompleted() ? 1 : 0
                ]);
            }
        }

        public function getAll(): array {
            $statement = $this->pdo->query("SELECT * FROM tasks");
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function findById(int $id): ?Task {
            $statement = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $statement->execute(['id' => $id]);
            $data = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            $task = new Task($data['title'], (int)$data['id']);
            if ($data['is_completed']) {
                $task->complete();
            }
            return $task;
        }

        public function delete(int $id): void {
            $statement = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
            $statement->execute(['id' => $id]);
        }
}