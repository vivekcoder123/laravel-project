<?php

Route::get('/', 'HomeController@index')->name('homepage');


Route::group(['middleware'=>['auth']],function(){

Route::get('/admin','HomeController@admin');
Route::get('/admin/operations','AdminOperationsController@operations')->name('admin.operations');
Route::get('/admin/operations/errors','AdminOperationsController@errors')->name('admin.errors');
Route::get('/admin/operations/{type}','AdminOperationsController@operationDetail')->name('admin.operationDetail');
Route::get('/admin/operations/errors/{type}','AdminOperationsController@errorDetail')->name('admin.errorDetail');
Route::get('/admin/license-history','HomeController@licenseHistory')->name('admin.licenseHistory');
Route::resource('/admin/posts','AdminPostsController',['names'=>[

  'index'=>'admin.posts.index',
  'store'=>'admin.posts.store',
  'create'=>'admin.posts.create',
  'edit'=>'admin.posts.edit',
  'destroy'=>'admin.posts.destroy'

 ]]);
Route::resource('/admin/users','AdminUsersController',['names'=>[

  'index'=>'admin.users.index',
  'store'=>'admin.users.store',
  'create'=>'admin.users.create',
  'edit'=>'admin.users.edit',
  'destroy'=>'admin.users.destroy'

 ]]);

});

Auth::routes();