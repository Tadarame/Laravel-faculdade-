<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores an uploaded image URL with a product', function () {
    $imageUrl = 'http://localhost/storage/files/product-image.jpg';

    $response = $this->postJson('/api/products', [
        'name' => 'Produto com imagem',
        'price' => 19.9,
        'image' => $imageUrl,
    ]);

    $response->assertCreated()
        ->assertJsonPath('image', $imageUrl);

    $this->assertDatabaseHas('products', [
        'name' => 'Produto com imagem',
        'image' => $imageUrl,
    ]);
});
