<?php
 
test("la somme de deux nombres", function () {
    $a = 7;
    $b = 5;
    $resultat = $a + $b;
    expect($resultat)->toBe(12);
});
it("Can substract two numbers", function () {
    $a = 10;
    $b = 4;
    $resultat = $a - $b;
    expect($resultat)->toBe(6);
});