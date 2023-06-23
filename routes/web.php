<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SessionController;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\RegistrationController;
// use Spatie\YamlFrontMatter\YamlFrontMatter;


Route::get( '/' , [PostController::class, 'index'])->name('home');
Route::get( 'posts/{post:slug}' , [PostController::class, 'show']);
Route::post( 'posts/{post:slug}/comments' , [CommentController::class, 'store']);

Route::get( 'register' , [RegistrationController::class, 'create'])->middleware('guest');
Route::post( 'register' , [RegistrationController::class, 'store'])->middleware('guest');

Route::get( 'login' , [SessionController::class, 'create'])->middleware('guest');
Route::post( 'login' , [SessionController::class, 'store'])->middleware('guest');
Route::post( 'logout' , [SessionController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', function(){

    request()->validate(['email' => 'required|email']);

    try {
        
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us21'
        ]);

        $response = $mailchimp->lists->addListMember('e3bdfe4e34',[
            'email_address' => request('email'),
            'status'        => 'subscribed'
        ]);

    } catch (Exception $e) {
        throw ValidationException::withMessages([
            'email' => 'This email could not be added to our newsletter list.'
        ]);
    }

    return redirect('/')
        ->with('success', 'You are now signed up for our newsletter!');
});