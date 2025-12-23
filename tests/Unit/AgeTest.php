<?php 
//     ***CAS DE BASE
test("cas de base : renvoie est majeur pour un age perieur 18 ans", function() {
    $result = estMajeur(24);
    expect($result)->toBeTrue();
});
test("cas de base : renvoie est majeur pour un age trictement inferieur 18 ans", function() {
    $result = estMajeur(12);
    expect($result)->toBeFalse();
});
test("cas de base : renvoie une exception pour un age négatif", function() {
    expect(fn() => estMajeur(-5))->toThrow(Exception::class);
    expect(fn() => estMajeur(-5))->toThrow("L'âge ne peut pas être négatif.");
});

//    ***CAS LIMITE
test("cas limite : renvoie une exception pour un age limité à PHP_INT_MIN", function() {
    expect(fn() => estMajeur(PHP_INT_MIN))->toThrow(InvalidArgumentException::class);
    expect(fn() => estMajeur(PHP_INT_MIN))->toThrow("L'âge est hors des limites autorisées.");
});
test("cas limite : renvoie une exception pour un age de -1", function() {
    expect(fn() => estMajeur(-1))->toThrow(Exception::class);
    expect(fn() => estMajeur(-1))->toThrow("L'âge ne peut pas être négatif.");
});
test("cas limite : renvoie est mineur pour l âge de de 0 ans", function(){
    $result = estMajeur(0);
    expect($result)->toBeFalse();
});
test("cas limite : renvoie est mineur pour l âge de de 17 ans", function(){
    $result = estMajeur(17);
    expect($result)->toBeFalse();
});
test("cas limite : renvoie est majeur pour un age de 18 ans", function() {
    $result = estMajeur(18);
    expect($result)->toBeTrue();
});
test("cas limite : renvoie est majeur pour l âge PHP_INT_MAX", function(){
    $result = estMajeur(PHP_INT_MAX);
    expect($result)->toBeTrue();
});


//       ***CAS D'EXPEPTION
test("cas d'exception : renvoie une exception pour un age inférieur à PHP_INT_MIN", function() {
    expect(fn() => estMajeur(PHP_INT_MIN - 1))->toThrow(InvalidArgumentException::class);
    expect(fn() => estMajeur(PHP_INT_MIN - 1))->toThrow("L'âge est hors des limites autorisées.");
});
test("cas d'exception : renvoie une exception pour un age supérieur à PHP_INT_MAX", function() {
    expect(fn() => estMajeur(PHP_INT_MAX + 1))->toThrow(TypeError::class);;

});

