<?php

test('cas de base : renvoie majeur', function () {
    $result = estMajeur(24);
    expect($result)->toBeTrue();
});

test('cas de base : renvoie mineur', function () {
    $result = estMajeur(12);
    expect($result)->toBeFalse();
});
test('cas de base :  exception pour un âge negatif', function(){
    estMajeur(-5);
})->throws(InvalidArgumentException::class, "L'âge ne peut pas etre negatif");


test('cas de limite : renvoie mineur si age égale à 17', function () {
    $result = estMajeur(17);
    expect($result)->toBeFalse();
});

it('cas limite : renvoie majeur pour age egal à 18', function(){
    $result = estMajeur(18);
    expect($result)->toBeTrue();
});




test('cas limite : renvoie mineur avec âge zéro', function () {
    $result = estMajeur(0);
    expect($result)->toBeFalse();
});

test('cas limite : lance une exception pour moins infini', function () {
    $infini = PHP_INT_MIN;
    estMajeur($infini);
})->throws(InvalidArgumentException::class, "L'âge ne peut pas etre negatif");

test('cas limite : renvoie majeur avec plus infini', function () {
    $result = estMajeur(PHP_INT_MAX);
    expect($result)->toBeTrue();
});

test('cas limite :  exception pour  -1', function () {
    estMajeur(-1);
})->throws(InvalidArgumentException::class, "L'âge ne peut pas etre negatif");


test("cas d'exception : lance une exception pour une valeur invalide trop inferieur ", function () {
    $moinsinfini = PHP_INT_MIN - 1;
    estMajeur($moinsinfini);
})->throws(InvalidArgumentException::class, "L'âge ne peut pas etre negatif");

test("cas d'exception : lance une exception pour une valeur invalide trop superieur ", function () {
    $plusinfini = PHP_INT_MAX + 1;
    estMajeur($plusinfini);
})->throws(TypeError::class);

