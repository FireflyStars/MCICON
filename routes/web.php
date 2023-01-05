<?php

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
// Route::get('/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/about-us', 'HomeController@index');
Route::get('/contact-us', 'HomeController@index');
Route::get('/privacy-policy', 'HomeController@index');
Route::get('/resource/rule', 'HomeController@index');
Route::get('/price', 'HomeController@index');
Route::get('/image/{id}', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@index');
Route::get('/login', 'MyAuth\LoginController@index');
Route::post('/login', 'MyAuth\LoginController@login');
Route::get('/get-auth-status', 'MyAuth\LoginController@sendUserStatus');
Route::get('/verify', 'HomeController@index');
Route::get('/verify/{token}', 'HomeController@index');

Route::post('/verify/{token}', 'MyAuth\VerificationController@verify');
Route::post('/resend/verifyemail', 'MyAuth\RegisterController@reSendVerifyEmail');

Route::get('/logout', 'MyAuth\LoginController@logout');
Route::get('/admin/logout', 'MyAuth\LoginController@adminLogout')->name('logout');
Route::get('/register', 'MyAuth\RegisterController@index');
Route::post('/register', 'MyAuth\RegisterController@register')->name('register');

Route::get('/password/recovery', 'MyAuth\ForgotPasswordController@index');
Route::post('/password/recovery', 'MyAuth\ForgotPasswordController@SendsPasswordResetEmails');

Route::get('/password/reset/{token}', 'MyAuth\ResetPasswordController@index');
Route::post('/password/reset', 'MyAuth\ResetPasswordController@passwordReset');

// admin part
Route::get('/account/dashboard', 'HomeController@index');
Route::get('/account/download-history', 'HomeController@index');
Route::post('/send/message', 'EmailController@sendMessage');

Route::get('/userinfo', 'UserInfoController@index');
Route::post('/userinfo/update', 'UserInfoController@userInfoUpdate');

Route::get('/admin', 'admin\CategoryController@index');

Route::get('/admin/about-us', 'admin\AboutUsController@index')->name('about-us.index');
Route::get('/admin/about-us/{id}', 'admin\AboutUsController@show');
Route::post('/admin/about-us/{id}', 'admin\AboutUsController@update');
Route::get('/get/about-us', 'admin\AboutUsController@sendDataToClient');

Route::get('/admin/privacy', 'admin\PrivacyController@index')->name('privacy.index');
Route::get('/admin/privacy/{id}', 'admin\PrivacyController@show');
Route::post('/admin/privacy/{id}', 'admin\PrivacyController@update');
Route::get('/get/privacy', 'admin\PrivacyController@sendDataToClient');

Route::get('/admin/price', 'admin\PriceController@index')->name('price.index');
Route::get('/admin/price/{id}', 'admin\PriceController@show');
Route::post('/admin/price/{id}', 'admin\PriceController@update');
Route::get('/get/price', 'admin\PriceController@sendDataToClient');

Route::get('/admin/resource-rule', 'admin\ResourceRuleController@index')->name('resource-rule.index');
Route::get('/admin/resource-rule/{id}', 'admin\ResourceRuleController@show');
Route::post('/admin/resource-rule/{id}', 'admin\ResourceRuleController@update');
Route::get('/get/resource-rule', 'admin\ResourceRuleController@sendDataToClient');

Route::get('/admin/category', 'admin\CategoryController@index')->name('category.index');
Route::get('/admin/category/show', 'admin\CategoryController@show');
Route::post('/admin/category', 'admin\CategoryController@store');
Route::post('/admin/category/{id}', 'admin\CategoryController@update');
Route::post('/admin/category/{id}/delete', 'admin\CategoryController@destroy');
Route::get('/get/gategory-images', 'admin\CategoryController@sendImages');

Route::get('/admin/category/{cate_id}/tags', 'admin\TagController@index')->name('cate-tag.index');
Route::post('/admin/category/{cate_id}/tags', 'admin\TagController@store')->name('cate-tag.create');
Route::post('/admin/category/tags/{tag_id}/update', 'admin\TagController@update')->name('cate-tag.update');
Route::get('/admin/category/tags/{tag_id}/delete', 'admin\TagController@destroy')->name('cate-tag.destroy');

Route::get('/admin/image/{image_id}/tags', 'admin\ImageTagController@index')->name('image-tag.index');
Route::post('/admin/image/{image_id}/tags', 'admin\ImageTagController@store')->name('image-tag.create');
Route::post('/admin/image/tags/{image_tag_id}/update', 'admin\ImageTagController@update')->name('image-tag.update');
Route::get('/admin/image/tags/{image_tag_id}/delete', 'admin\ImageTagController@destroy')->name('image-tag.destroy');

Route::get('/admin/category/{cate_id}/images', 'admin\ImageController@index')->name('image.index');
Route::post('/admin/category/{cate_id}/images', 'admin\ImageController@store');
Route::post('/admin/category/{cate_id}/images/{image_id}/update', 'admin\ImageController@update');
Route::post('/admin/category/images/{image_id}/delete', 'admin\ImageController@destroy');
Route::get('/images/{image_id}/download', 'admin\ImageController@download');
Route::get('/get/most-downloaded-images', 'admin\ImageController@sendMostDownloadedImages');
Route::get('/get/category-gallery/{cate_id}', 'admin\ImageController@sendCategoryGallery');
Route::get('/get/category-gallery-by-image-id/{image_id}', 'admin\ImageController@sendCategoryGalleryByImageId');
Route::post('/search', 'admin\ImageController@searchImages');

// Route::get('/admin/image/{id}/tags', 'admin\TagController@index')->name('cate-tag.index');
// Route::post('/admin/image/{id}/tags', 'admin\TagController@store')->name('cate-tag.create');
// Route::get('/admin/image/{id}/tags/update', 'admin\TagController@update')->name('cate-tag.update');
// Route::get('/admin/image/{id}/tags/delete', 'admin\TagController@destroy')->name('cate-tag.destroy');
// Route::get('/', function () {
//     return view('app');
// });
