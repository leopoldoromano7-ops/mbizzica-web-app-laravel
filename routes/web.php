<?php

use App\Http\Controllers\PasteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

//View homepage / welcome
Route::get('/', [PublicController::class, 'home'])->name('homepage');

Route::get('pastes/index', [PasteController::class, 'index'])->name('pastes.index');
Route::get('pastes/create', [PasteController::class, 'create'])->name('pastes.create');
Route::post('paste/store', [PasteController::class, 'store'])->name('paste.store');
Route::get('/paste/{id}/attachment', [PasteController::class, 'showAttachment'])->name('paste.attachment.show');
Route::get('/paste/{id}/attachment/download', [PasteController::class, 'downloadAttachment'])->name('paste.attachment.download');

//url univocas
Route::get('/paste/{url}', [PasteController::class, 'show'])->name('paste.show');

Route::middleware(['auth'])->group(function () {
    //Paste routes
    // crud per pste al sinfgolare per convenzione
    Route::get('/pastes/{id}/edit', [PasteController::class, 'edit'])->name('paste.edit');
    Route::put('/pastes/{id}', [PasteController::class, 'update'])->name('paste.update');
    Route::delete('/paste/{url}', [PasteController::class, 'destroy'])->name('paste.destroy'); 

    });
    
// [aste download route
Route::get('/paste/download/{id}', [PasteController::class, 'download'])->name('paste.download');
Route::post('/paste/{id}/share', [PasteController::class, 'share'])->name('paste.share');
//trotta per abbilitare l'autenticazione a due fattori

Route::get('/settings/two-factor', [ProfileController::class, 'twoFactor'])->middleware(['auth'])->name('settings.two-factor');
//Rotta per reimpostare password https://chatgpt.com/c/697641b2-79b0-8325-af08-1c7b0c52948f - uo funcion qui anche se sarebbe migliore nel controller solo che 
Route::get('/forgot-password', [ProfileController::class, 'showForgotPasswordForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ProfileController::class, 'ResetPass'])->middleware('guest')->name('password.email');


//roote contacttaci
Route::get('/newsletter', [MailController::class, 'news'])->name('contact.us');
Route::post('/send-email', [MailController::class, 'send_email'])->name('send.email');

//rotte comment i
Route::post('/paste/{paste}/comment', [PasteController::class, 'storeComment'])->name('paste.comment'); 
