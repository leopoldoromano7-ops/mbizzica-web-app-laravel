<?php

use App\Models\Paste;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('redirects unlisted pastes to the show page after creation', function () {
    Storage::fake('public');

    $response = $this->post(route('paste.store'), [
        'title' => 'Guest unlisted paste',
        'content' => 'This should open directly on show.',
        'visibility' => 2,
        'tags' => 'guest,unlisted',
    ]);

    $paste = Paste::firstOrFail();

    $response
        ->assertRedirect(route('paste.show', $paste->url))
        ->assertSessionHas('status');
});

it('keeps redirecting public pastes back to the create page', function () {
    Storage::fake('public');

    $response = $this->post(route('paste.store'), [
        'title' => 'Public paste',
        'content' => 'This should go back to create.',
        'visibility' => 0,
        'tags' => 'public',
    ]);

    $response
        ->assertRedirect(route('pastes.create'))
        ->assertSessionHas('status');
});
