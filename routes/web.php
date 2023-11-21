<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('dashboard');
// })->name('home');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::resource('podcasts', 'PodcastController');

        Route::patch('podcasts/{podcast}/', 'PodcastController@update')->name('podcasts.update');

        Route::post('podcasts/content/store/{podcast}', 'PodcastDetailsController@store')->name('podcasts.content.store');
        Route::get('podcasts/{podcast}/{podcastDetail}', 'PodcastDetailsController@edit')->name('podcasts.content.edit');
        Route::patch('podcasts/{podcast}/{podcastDetail}', 'PodcastDetailsController@update')->name('podcasts.content.update');
        Route::delete('podcasts/{podcast}/{podcastDetail}', 'PodcastDetailsController@destroy')->name('podcasts.details.content.destroy');
        Route::resource('categories', 'CategoryController');
        Route::patch('categories/change-status/{category}', 'CategoryController@changeStatus')->name('categories.status.change');
        Route::patch('podcasts-content/update-status/{podcast}', 'PodcastController@changePodcastStatus')->name('podcasts.status.change');

        Route::patch('podcasts-details/status-update-change/{podcastDetail}', 'PodcastDetailsController@podcastDetailsStatusChange')->name('podcast-details.status.update.change');

        //rj profile
        Route::resource('rj-profiles', 'RJProfileController');
        Route::patch('rj-profiles/change-status/{profile}', 'RJProfileController@changeRJProfileStatus')->name('rj-profiles.status.change');

        // photo gallery
        Route::resource('photo-galleries', 'PhotoGalleryController');

        //gallery details
        Route::post('photo-galleries/details/{photo_gallery}', 'GalleryDetailsController@store')->name('photo-galleries.details.store');
        Route::delete('photo-galleries/details/{photo_gallery}/{gallery_details}', 'GalleryDetailsController@destroy')->name('photo-galleries.details.destroy');

        // promotions
        Route::resource('promotions', 'PromotionController');
        Route::patch('promotions/change-promotion-status/{promotion}', 'PromotionController@changePromotionStatus')->name('promotions.status.change');

        //segments
        Route::resource('segments', 'SegmentController');
        Route::patch('segments/change-segment-status/{segment}', 'SegmentController@changeSegmentStatus')->name('segments.status.change');

        //announcers
        Route::resource('announcers', 'AnnouncerController');
        Route::patch('announcers/change-announcer-status-update/{announcer}', 'AnnouncerController@changeAnnouncerStatus')->name('announcers.status.change');

        //highlights
        Route::resource('highlights', 'HighlightsController');

    });
});
