<?php

Route::get('/', 'HomeController@index')->name('homepage');


Route::group(['middleware'=>['auth']],function(){

Route::get('/admin','HomeController@admin');
Route::get('/admin/operations','AdminOperationsController@operations')->name('admin.operations');
Route::get('/admin/operations/{type}','AdminOperationsController@operationDetail')->name('admin.operationDetail');

Route::get('/admin/errors','AdminErrorsController@errors')->name('admin.errors');

Route::get('/admin/errors/{type}','AdminErrorsController@errorDetail')->name('admin.errorDetail');

Route::resource('/admin/licenses','AdminLicensesController',['names'=>[

  'index'=>'admin.licenses.index',
  'store'=>'admin.licensens.store',
  'create'=>'admin.licenses.create',
  'edit'=>'admin.licenses.edit',
  'destroy'=>'admin.licenses.destroy'

 ]]);
Route::get('/admin/licenses/graph','AdminLicensesController@graph')->name('admin.licenses.graph');
Route::resource('/admin/posts','AdminPostsController',['names'=>[

  'index'=>'admin.posts.index',
  'store'=>'admin.posts.store',
  'create'=>'admin.posts.create',
  'edit'=>'admin.posts.edit',
  'destroy'=>'admin.posts.destroy'

 ]]);
Route::resource('/admin/site-credentials','AdminSiteCredentialsController',['names'=>[

  'index'=>'admin.site-credentials.index',
  'store'=>'admin.site-credentials.store',
  'create'=>'admin.site-credentials.create',
  'edit'=>'admin.site-credentials.edit',
  'destroy'=>'admin.site-credentials.destroy'

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