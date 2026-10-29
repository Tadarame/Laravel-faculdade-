<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('stores an uploaded file and returns its path', function () {
    Storage::fake('public');

    $response = $this->post('/api/upload', [
        'file' => UploadedFile::fake()->create('manual.pdf', 300, 'application/pdf'),
    ]);

    $response->assertOk()
        ->assertJsonStructure(['path', 'url']);

    Storage::disk('public')->assertExists($response->json('path'));
});

it('rejects files larger than 30 MB', function () {
    Storage::fake('public');

    $response = $this->post('/api/upload', [
        'file' => UploadedFile::fake()->create('large-file.bin', 30 * 1024 + 1),
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors('file');
});
