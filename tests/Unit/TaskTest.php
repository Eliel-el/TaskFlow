<?php
use TaskFlow\Task;
use InvalidArgumentException;
use Pest\Support\Str;
describe("F.1.3 utilisateur doit pouvoir marquer une tâche comme complétée", function () {

    test('tache est non complétée a la creation', function () {
        $task = new Task('Apprendre Pest');
        expect($task->isCompleted())->toBeFalse();
    });

    test('une tâche peut être marquée comme complétée', function () {
        $task = new Task('utiliser supabase');
        $task->complete();
        expect($task->isCompleted())->toBeTrue();
    });

});

describe("NF2.2 : Le titre d'une tache doit etre valide", function(){
    /**
     * classe d'equivalences : 
     * titre ayant 5 a 255 caracteres -> titre valide : Ex cas "saluer joel"
     * titre ayant 0 a 4 cars -> titre invalide : EX. cas "ICI"
     * titre ayant plus de 255 -> titre invalide : Ex. cas str_repeat("A", 300)
     * 
     * cas limites : 
     * cas 1 : ""
     * cas 2 : "1234"
     * cas 3 : str_repeat("A", 255)
     * cas 4 : str_repeat("A", 256)
     * 
     * cas d'exception
     * titre ayant seulement des espace titre invalide : EX. cas
     */

    test("cas limite : un titre vide", function(){
        $task = new Task('');
    })->throws(InvalidArgumentException::class, "le titre est vide");

    test("cas limites : titre de quatre caracteres", function(){
        $task = new Task('1234');
    })->throws(InvalidArgumentException::class, "le titre est trop court");

    

    test("cas limite : titre ayant 5 caracteres", function(){
        $task = new Task("12345");
        expect($task->isCompleted())->toBeFalse();
    });

    test("cas limite : titre ayant 255 caracteres", function(){
        $task = new Task(str_repeat('A', 255));
        expect($task->isCompleted())->toBeFalse();
    });

    test("cas limite : titre ayant 256 caracteres", function(){
        $task = new Task(str_repeat('A', 256));
    })->throws(InvalidArgumentException::class, "le titre est trop long");


    test("cas des base : titre ayant 500 caracteres", function(){
        $task = new Task(str_repeat('A', 500));
        expect($task->isCompleted())->toBeFalse();
    })->throws(InvalidArgumentException::class, "le titre est trop long");

    test("cas de base  : titre ayant 2 caracteres", function(){
        $task = new Task('12');
       
    })->throws(InvalidArgumentException::class, "le titre est trop court");

    
     test("cas de base : titre ayant 100 caracteres", function(){
        $task = new Task(str_repeat('A', 100));
        expect($task->isCompleted())->toBeFalse();
    });


    

});

