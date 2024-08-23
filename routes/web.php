<?php

use Illuminate\Support\Facades\Route;

use App\Models\Request as RequestModel;

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
    return redirect('admin');
});

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('maintenance', function () {
    return view('errors.maintenance');
})->name('errors.maintenance');

Route::group(['prefix' => 'admin', 'middleware' => ['desarrollo.creativo']], function () {
    Voyager::routes();

    Route::get('generate-qr', function () {
        return view('generate-qr.browse');
    });
});

Route::get('admin/files/{id}', function ($id) {
    $file = App\Models\File::find($id);     

    RequestModel::create([
        'ip' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'device' => isMobile(request()->userAgent()) ? 'mobile' : 'desktop',
        'url' => request()->url(),
        'date' => date('Y-m-d H:i:s'),
    ]);

    if($file->file != '[]'){
        return redirect('storage/'.json_decode($file->file)[0]->download_link);
    }
    return redirect($file->url);
})->name('voyager.files.show');

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
