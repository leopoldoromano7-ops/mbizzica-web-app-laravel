<?php

use App\Models\Paste;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('shows a public attachment without relying on the storage symlink', function () {
    Storage::fake('public');
    Storage::disk('public')->put('attachments/public-image.png', 'fake image');

    $paste = Paste::create([
        'title' => 'Public paste',
        'content' => 'Test content',
        'visibility' => 0,
        'url' => Str::random(10),
        'file_path' => 'pastes/public.txt',
        'attachment_path' => 'attachments/public-image.png',
    ]);

    $this->get(route('paste.attachment.show', $paste->id))
        ->assertOk();
});

it('downloads an attachment with a readable filename', function () {
    Storage::fake('public');
    Storage::disk('public')->put('attachments/public-image.png', 'fake image');

    $paste = Paste::create([
        'title' => 'Public paste',
        'content' => 'Test content',
        'visibility' => 0,
        'url' => Str::random(10),
        'file_path' => 'pastes/public.txt',
        'attachment_path' => 'attachments/public-image.png',
    ]);

    $this->get(route('paste.attachment.download', $paste->id))
        ->assertOk()
        ->assertDownload('public-paste.png');
});

it('forbids viewing a private attachment to non owners', function () {
    Storage::fake('public');
    Storage::disk('public')->put('attachments/private-image.png', 'fake image');

    $owner = User::factory()->create();

    $paste = Paste::create([
        'title' => 'Private paste',
        'content' => 'Secret content',
        'visibility' => 1,
        'url' => Str::random(10),
        'file_path' => 'pastes/private.txt',
        'attachment_path' => 'attachments/private-image.png',
        'user_id' => $owner->id,
    ]);

    $this->get(route('paste.attachment.show', $paste->id))
        ->assertForbidden();
});
