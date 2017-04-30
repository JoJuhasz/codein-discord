<?php
Route::get('/discord/login', 'Codein\Discord\Http\Controllers\Discord\LoginController@login');
Route::get('/discord/login/redirect', 'Codein\Discord\Http\Controllers\Discord\LoginController@redirect');
Route::get('/discord/join', 'Codein\Discord\Http\Controllers\Discord\JoinController@join');