<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

use function GuzzleHttp\Promise\all;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/{id}', function($user_id){
    //create a post of a certain user
    $user = User::findOrFail($user_id);
    //create the actual post
    $post = new Post(['title'=>'Friday schedule','body'=>'mt249 test on friday again']);

    $user->posts()->save($post);
});

Route::get('/read/{id}', function($id){
    $user = User::findOrFail($id);

    foreach($user->posts as $post){
        echo $post->title . '<br>';
    }
});

Route::get('/update/{id}', function($id){
    $user = User::findOrFail($id);
    //different from onetoone
    //access this user's post
    //different form posts and posts()
    //use post without paranthesis if you want to only access its properties
    //post() when you want to chain other methods
    $user->posts()->whereId(2)->update(['title'=>'Update title','body'=> 'updated mt249 body']);
    
});

Route::get('/delete', function(){
    $user = User::findOrFail(1);

    $user->posts()->where('id','=',3)->delete();

    return 'Successfully deleted';
});