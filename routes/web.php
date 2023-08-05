<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\GotoManagerPage;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// landing

Route::get('/',[PostsController::class , 'landing'])->name('landing');
route::get('/post/{id}', [PostsController::class, 'showPost'])->name('post-show');

Route::middleware(['manager'])->group(function () {
    Route::get('/dashboard/management', [GotoManagerPage::class, 'index'])->name('dashboard-management');
    //users
    Route::get('/users', [UserController::class, 'showTable'])->name('users-table');
    Route::get('/users/fetch', [UserController::class, 'fetchData'])->name('fetchData');
    Route::post('/users/changeRole', [UserController::class, 'changeRole'])->name('users-changeRole');
    Route::post('/users/ban', [UserController::class, 'ban'])->name('users-ban');
    Route::post('/users/unBan', [UserController::class, 'unBan'])->name('users-unBan');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users-delete');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users-edit');
    Route::post('/users/edit/getinfo',[UserController::class, 'getinfo'])->name('users_edit_getinfo');
    Route::post('/users/edit/editInfo' , [UserController::class, 'edit_info'])->name('user_edit_informations');
    Route::post('/users/edit/editImg' , [UserController::class, 'edit_img'])->name('user_edit_img');
    Route::post('/users/edit/editPassword' , [UserController::class, 'edit_password'])->name('user_edit_password');
    Route::get('/users/newUser' , [UserController::class, 'newUser'])->name('new-user');
    Route::post('/users/addUser' , [UserController::class, 'addUser'])->name('add-user');


});

Route::middleware(['writer'])->group(function () {

    Route::get('/posts/allPosts', [PostsController::class, 'index'])->name('posts-all');

    Route::post('/posts/allPosts/delete', [PostsController::class, 'delete'])->name('post-delete');

    Route::post('/posts/allPosts/submit', [PostsController::class, 'submit'])->name('post-submit');
    Route::post('/posts/allPosts/unsubmit', [PostsController::class, 'unsubmit'])->name('post-unsubmit');

    Route::get('/posts/allPosts/edit/{id}', [PostsController::class, 'edit'])->name('post-edit');

    route::post("/posts/allposts/edit/update", [PostsController::class, 'update'])->name('post-update');

    Route::get('/posts/newpost', [PostsController::class, 'show'])->name('posts-newpost');

    Route::post("/newPost", [PostsController::class, 'store'])->name('post-store');

    Route::post("/PostImgUpload", [PostsController::class, 'PostImgUpload'])->name('Post.img.upload');


    Route::get('/posts/genres', [GenresController::class, 'index'])->name('posts-categories');
    Route::post('/posts/genres/add', [GenresController::class, 'add'])->name('categories-add');
    Route::post('/posts/genres/delete', [GenresController::class, 'delete'])->name('categories-delete');

    Route::get('/posts/tags', [TagsController::class, 'index'])->name('posts-tags');

    Route::post('/posts/tags/add', [TagsController::class, 'add'])->name('tags-add');
    Route::post('/posts/tags/delete', [TagsController::class, 'delete'])->name('tags-delete');
});
Route::get('/dashboard', function () {
    return view('dashboard/profile/profile');
})->name('dashboard-profile')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::post('/dashboard/profile/getProfile',[ProfileController::class, 'getProfile'])->name('getProfile');
    Route::post('/dashboard/profile/editInformations', [ProfileController::class, 'edit_informations'])->name('edit_informations');
    Route::post('/dashboard/profile/editPassword', [ProfileController::class, 'edit_password'])->name('edit_password');
    route::post('/dashboard/profile/addImg', [ProfileController::class, 'add_user_img'])->name('add_user_img');
});

















//wigets
route::get('/Wigets', function () {
    return view('wigets');
})->name('wigets');


//charts
route::get('/charts/chartjs', function () {
    return view('charts.chartjs');
})->name('charts-chartjs');

route::get('/charts/flot', function () {
    return view('charts.flot');
})->name('charts-flot');

route::get('/charts/inline', function () {
    return view('charts.inline');
})->name('charts-inline');




// Graphic objects
route::get('/UI/general', function () {
    return view('UI.general');
})->name('UI-general');

route::get('/UI/icons', function () {
    return view('UI.icons');
})->name('UI-icons');

route::get('/UI/buttons', function () {
    return view('UI.buttons');
})->name('UI-buttons');

route::get('/UI/sliders', function () {
    return view('UI.sliders');
})->name('UI-sliders');



// forms
route::get('/forms/general', function () {
    return view('forms.general');
})->name('forms-general');

route::get('/forms/editors', function () {
    return view('forms.editors');
})->name('forms-editors');

route::get('/forms/advanced', function () {
    return view('forms.advanced');
})->name('forms-advanced');


// tables

route::get('/tables/simple', function () {
    return view('tables.simple');
})->name('tables-simple');

route::get('/tables/data', function () {
    return view('tables.data');
})->name('tables-data');


// calendar

route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');



// mailbox
route::get('/mailbox/inbox', function () {
    return view('mailbox.inbox');
})->name('mailbox-inbox');

route::get('/mailbox/composer', function () {
    return view('mailbox.compose');
})->name('mailbox-compose');

route::get('/mailbox/read-mail', function () {
    return view('mailbox.read-mail');
})->name('mailbox-read-mail');


//pages
route::get('/pages/invoice', function () {
    return view('pages.invoice');
})->name('pages-invoice');

route::get('/pages/invoice-print', function () {
    return view('pages.invoice-print');
})->name('pages-invoice-print');

route::get('/pages/profile', function () {
    return view('pages.profile');
})->name('pages-profile');

route::get('/pages/login', function () {
    return view('pages.login');
})->name('pages-login');

route::get('/pages/register', function () {
    return view('pages.register');
})->name('pages-register');


route::get('/pages/lockscreen', function () {
    return view('pages.lockscreen');
})->name('pages-lockscreen');


























// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
