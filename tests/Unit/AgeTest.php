<?php 

test("renvoie est majeur pour un age perieur 18 ans", function() {
    $result = estMajeur(24);
    expect($result)->toBeTrue();
});
test("renvoie est majeur pour un age trictement inferieur 18 ans", function() {
    $result = estMajeur(12);
    expect($result)->toBeFalse();
});

test("renvoie est majeur pour un age de 18 ans", function() {
    $result = estMajeur(18);
    expect($result)->toBeTrue();
});

test("renvoie une exception pour un age négatif", function() {
    expect(fn() => estMajeur(-5))->toThrow(Exception::class);
    expect(fn() => estMajeur(-5))->toThrow("L'âge ne peut pas être négatif.");
});