<?php

function estMajeur(int $age): bool
{
    try {
        // Cas hors limites extrêmes
    if ($age === PHP_INT_MIN) {
        throw new InvalidArgumentException("L'âge est hors des limites autorisées.");
    }
    if ($age === PHP_INT_MAX + 1) {
        throw new InvalidArgumentException("L'âge est hors des limites autorisées.");
    }
    if ($age === PHP_INT_MIN - 1) {
        throw new InvalidArgumentException("L'âge est hors des limites autorisées.");
    }
    

    // Âge négatif
    if ($age < 0) {
        throw new InvalidArgumentException("L'âge ne peut pas être négatif.");
    }

    return $age >= 18;
    } catch (TypeError $e) {
        throw new InvalidArgumentException("L'âge est hors des limites autorisées.");
    }
}

