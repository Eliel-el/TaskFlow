<?php 

use GuzzleHttp\Client;

test('recuperation de la liste des tâche dans la bdd', function() {
    $client = new Client([
        'base_uri' => 'http://localhost:8000',
        'http_errors' => false,
    ]);

    // Créer une tâche pour s'assurer qu'il y a au moins une tâche dans la liste
    $response = $client->get('/api/tasks');
    expect($response->getStatusCode())->toBe(200);

    $body = json_decode($response->getBody(), true);

    expect($body)->toHaveKey('data');
    expect($body['data'])->toBeArray();
});

test('enregistre une nouvelle tâche et renvoie le statut 201', function() {
    $client = new Client([
        'base_uri' => 'http://localhost:8000',
        'http_errors' => false,
    ]);

    $response = $client->post('/api/tasks', [
        'json' => [
            'title' => 'Termine le tp n 9'
        ]
    ]);

    expect($response->getStatusCode())->toBe(201);

    $body = json_decode($response->getBody(), true);

    expect($body)->toHaveKey('data');
    expect($body['data'])->toHaveKey('title', 'Termine le tp n 9');
    expect($body['data'])->toHaveKey('is_completed', false);
});

test('renvoie le statut 422 pour un titre trop court', function() {
    $client = new Client([
        'base_uri' => 'http://localhost:8000',
        'http_errors' => false,
    ]);

    $response = $client->post('/api/tasks', [
        'json' => [
            'title' => 'abc'
        ]
    ]);

    expect($response->getStatusCode())->toBe(422);

    $body = json_decode($response->getBody(), true);

    expect($body)->toHaveKey('error');
    expect($body['error'])->toContain('entre 5 et 255 caractères');
});

test('renvoie le statut 404 pour une route introuvable', function() {
    $client = new Client([
        'base_uri' => 'http://localhost:8000',
        'http_errors' => false,
    ]);

    $response = $client->get('/api/unknown-route');

    expect($response->getStatusCode())->toBe(404);

    $body = json_decode($response->getBody(), true);

    expect($body)->toHaveKey('error');
    expect($body['error'])->toBe('Route introuvable');
});