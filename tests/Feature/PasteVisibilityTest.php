<?php

use App\Models\Paste;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('does not list guest unlisted pastes in the public archive', function () {
    $paste = Paste::create([
        'title' => 'Guest unlisted paste',
        'content' => 'Secret but reachable by url',
        'visibility' => 2,
        'url' => Str::random(10),
        'file_path' => 'pastes/guest-unlisted.txt',
        'attachment_path' => null,
        'user_id' => null,
    ]);

    $this->get(route('pastes.index'))
        ->assertOk()
        ->assertDontSeeText($paste->title);
});

it('keeps guest unlisted pastes reachable through the direct show link', function () {
    $paste = Paste::create([
        'title' => 'Guest unlisted paste',
        'content' => 'Secret but reachable by url',
        'visibility' => 2,
        'url' => Str::random(10),
        'file_path' => 'pastes/guest-unlisted.txt',
        'attachment_path' => null,
        'user_id' => null,
    ]);

    $this->get(route('paste.show', $paste->url))
        ->assertOk()
        ->assertSeeText($paste->title);
});

it('still lists an authenticated users own unlisted paste in their archive', function () {
    $user = User::factory()->create();

    $paste = Paste::create([
        'title' => 'Owner unlisted paste',
        'content' => 'Only the owner should see this in archive',
        'visibility' => 2,
        'url' => Str::random(10),
        'file_path' => 'pastes/owner-unlisted.txt',
        'attachment_path' => null,
        'user_id' => $user->id,
    ]);

    $this->actingAs($user)
        ->get(route('pastes.index'))
        ->assertOk()
        ->assertSeeText($paste->title);
});
