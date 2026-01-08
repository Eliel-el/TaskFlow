<?php
Use TaskFlow\Task;

describe("F.1.3 : L'utilisateur doit pouvoir marquer une tache comme completee", function () {


    test("cas d'exception : renvoie une exception pour un age supérieur à PHP_INT_MAX", function() {
        expect(fn() => estMajeur(PHP_INT_MAX + 1))->toThrow(TypeError::class);;

    });
    
    
});