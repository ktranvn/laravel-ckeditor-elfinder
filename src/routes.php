<?php

Route::get('test-editor', [Ktran\CE\Controllers\CEController::class, 'test']);

Route::get('/file-manager/popup/{input_id}', [\Barryvdh\Elfinder\ElfinderController::class, 'showPopup']);
Route::get('/file-manager/ckeditor', [Ktran\CE\Controllers\CEController::class, 'editor']);
Route::any('/file-manager/connector', [Barryvdh\Elfinder\ElfinderController::class, 'showConnector']);
Route::post('/file-manager/connector', [Ktran\CE\Controllers\CEController::class, 'upload']);