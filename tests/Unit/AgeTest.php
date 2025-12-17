<?php 

test("renvoie est majeur pour un age de 18 ans", function() {
    $result = estMajeur(18);
    expect($result)->toBeTrue();
});
test("renvoie est majeur pour un age de 25 ans", function() {
    $result = estMajeur(25);
    expect($result)->toBeTrue();
});

test("renvoie est mineur pour un age de 17 ans", function() {
    $result = estMajeur(17);
    expect($result)->toBeFalse();
});

test("renvoie une exception pour un age négatif", function() {
    expect(fn() => estMajeur(-5))->toThrow(Exception::class);
    expect(fn() => estMajeur(-5))->toThrow("L'âge ne peut pas être négatif.");
});