<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'images' => Image::all()
    ]);
});

Route::post('/', function () {
    $files = request('file');
    foreach($files as $file) {
        // Get file size
        $filesize = $file->getSize();
        // Get file dimemsion
        $dimension = getimagesize($file);
        $width = $dimension[0];
        $height = $dimension[1];
        // Upload image and get path
        $name = $file->store('images', 'public');

        Image::create(compact('name', 'filesize', 'width', 'height'));
    }
    return 'upload';
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
