<?php
namespace TaskFlow;
use InvalidArgumentException;
class Task {
    protected ?int $id = null;
    protected string $title;
    protected bool $isCompleted = false;

    public function __construct(string $title, ?int $id = null) {
        if(strlen($title) >= 5 and strlen($title) <= 255) {
            $this->title = $title;
        } else {
            throw new InvalidArgumentException("Le titre doit contenir entre 5 et 255 caractères.");
        }
        $this->isValidTitle($title);
        $this->title = $title;
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function isCompleted(): bool {
        return $this->isCompleted;
    }

    public function complete(): void {
        $this->isCompleted = true;
    }

    private function isValidTitle(string $title): void {
        $trimmedTitle = trim($title);
        
        if ($title === '') {
            throw new InvalidArgumentException("le titre est vide");
        }
        
        if (strlen($trimmedTitle) === 0) {
            throw new InvalidArgumentException('le titre contient des espaces');
        }

        if (strlen($title) < 5) {
            throw new InvalidArgumentException("le titre est trop court");
        }

        if (strlen($title) > 255) {
            throw new InvalidArgumentException("le titre est trop long");
        }
    }
}