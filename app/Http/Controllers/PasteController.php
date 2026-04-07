<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\User;
use App\Services\PasteFileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Tag;

class PasteController extends Controller
{ //aggiunte request per il filtro
    public function index(Request $request)
    {
        //solo se utente e' auth allore dagli id senno null
        $userId = Auth::check() ? Auth::id() : null;
        $tags = Tag::query()->orderBy('name')->get();

        // unlisted e privati non devono finire nell'archivio guest
        $pastes = Paste::query();

        if ($userId) {
            $pastes->where(function ($q) use ($userId) {
                $q->where('visibility', 0)->orWhere('user_id', $userId);
            });
        } else {
            $pastes->where('visibility', 0);
        }

        // se non raggruppocome passa il filtro
        if ($request->tag) {
            $pastes->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        //per titolo o contenuto todo fetch o livewere
        if ($request->q) {
            $pastes->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('content', 'like', '%' . $request->q . '%');
            });
        }

        $pastes = $pastes->latest()->paginate(10);
        // uso compact per creare una variabile che contenga tutta la collection di paste nella index
        return view('pastes.index', compact('pastes', 'tags'));
    }

    public function create()
    {
        return view('pastes.create');
    }

    // Dependency injjection
    public function store(Request $request, PasteFileService $fileService)
    {
        // dd($request->all());
        //richiamo il mas asignment
        // Paste::create($request->all());

        //validazione/
        $request->validate([
            'attachment' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,txt,doc,docx'
        ]);

        $path = $fileService->storeFile($request->content);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $url = Str::random(10);

        $paste = Paste::create([

            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $path,
            'attachment_path' => $attachmentPath,
            'visibility' => $request->visibility,
            'user_id' => Auth::id(),
            'url' => $url,
        ]);
        //miiii sembra di essere tornati a java
        $tagIds = collect(explode(',', $request->tags ?? ''))->map(fn($t) => trim($t))->filter()->map(fn($t) => Tag::firstOrCreate(['name' => $t])->id)->toArray();

        $paste->tags()->sync($tagIds);

        if ((int) $paste->visibility === 2) {
            return redirect()
                ->route('paste.show', $paste->url)
                ->with('status', 'Paste non elencato creato. Da qui puoi copiare e condividere il link.');
        }

        return redirect()
            ->route('pastes.create')
            ->with('status', 'Paste creato veramente bene figa!');
    }

    // sono stupido ma non so perche mi da rosso in teoria vVa nel disco public e prende il file nel percorso
    public function download($id)
    {
        // findOrFail metodo che cerca il paste, grazie documentazione e maledetta aulab. Cosi evito l'if
        $paste = Paste::findOrFail($id);

        return Storage::disk('public')->download($paste->file_path);
    }

    public function showAttachment($id)
    {
        $paste = $this->resolveAttachmentPaste($id);
        $attachmentPath = Storage::disk('public')->path($paste->attachment_path);

        return response()->file($attachmentPath, [
            'Content-Type' => Storage::disk('public')->mimeType($paste->attachment_path) ?: 'application/octet-stream',
        ]);
    }

    public function downloadAttachment($id)
    {
        $paste = $this->resolveAttachmentPaste($id);
        $extension = $paste->attachmentExtension();
        $filename = Str::slug($paste->title ?: 'allegato');

        if ($extension) {
            $filename .= '.' . $extension;
        }

        return Storage::disk('public')->download($paste->attachment_path, $filename);
    }

    public function show($url)
    {
        $paste = Paste::where('url', $url)->firstOrFail();

        if ($paste->visibility == 1 && Auth::id() !== $paste->user_id) {
            abort(403);
        }

        return view('pastes.show', compact('paste'));
    }


    //CONDIVISIONE  

    public function share(Request $request, $pasteId)
    {
        $paste = Paste::findOrFail($pasteId);

        if (Auth::id() !== $paste->user_id) {
            abort(403);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $paste->users()->attach($user->id);

        return back()->with('status', 'Link condiviso con successo!');
    }
    //inzio crud
    public function edit($id)
    {
        $paste = Paste::findOrFail($id);

        if (Auth::id() !== $paste->user_id) {
            abort(403);
        }

        return view('pastes.edit', compact('paste'));
    }

    /// copio incolo sotre
    public function update(Request $request, $id, PasteFileService $fileService)
    {
        $paste = Paste::findOrFail($id);

        // se e; authproprietareio
        if (Auth::id() !== $paste->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'visibility' => 'required|in:0,1,2',
            'attachment' => 'nullable|file|max:20480',
            'tags' => 'nullable|string'
        ]);

        $tagIds = collect(explode(',', $request->tags ?? ''))->map(fn($t) => trim($t))->filter()->map(fn($t) => Tag::firstOrCreate(['name' => $t])->id)->toArray();

        $paste->tags()->sync($tagIds);
        //file
        if ($data['content'] !== $paste->content) {
            $data['file_path'] = $fileService->storeFile($data['content']);
        }

        if ($request->hasFile('attachment')) {
            $data['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }


        $paste->update($data);

        return redirect()->route('paste.show', $paste->url);
    }
    //delete
    public function destroy($id)
    {
        $paste = Paste::findOrFail($id);

        //canzella file
        if ($paste->attachment_path) {
            Storage::disk('public')->delete($paste->attachment_path);
        }

        $paste->delete();

        Storage::disk('public')->delete($paste->file_path);

        return redirect()->route('pastes.index');
    }

    public function storeComment(Request $request, $pasteId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $paste = Paste::findOrFail($pasteId);

        $paste->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('status', 'Commento aggiunto!');
    }

    protected function resolveAttachmentPaste($id): Paste
    {
        $paste = Paste::findOrFail($id);

        if ($paste->visibility == 1 && Auth::id() !== $paste->user_id) {
            abort(403);
        }

        if (!$paste->attachment_path || !Storage::disk('public')->exists($paste->attachment_path)) {
            abort(404);
        }

        return $paste;
    }
}

    // non funge
    //if (!$paste) {
    //     abort(404);
    // }
