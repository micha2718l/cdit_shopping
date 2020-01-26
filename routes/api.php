<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| list -> get shopping list
| additem -> add item to list
|
*/


Route::get('/list/{list_id}', function ($list_id) {

    $list = DB::select('SELECT * FROM `lists` WHERE `list_id` = ?', [$list_id]);

    return response()->json($list);
});

Route::post('/additem', function (Request $request) {
    $list_id = $request->input('list_id');
    $item = $request->input('item');

    if ($list_id) {
        $query = 'INSERT INTO `lists` (`list_id`, `item`) VALUES (?, ?)';
        try {
            DB::insert($query, [$list_id, $item]);
            $status = 'success';
        } catch (Exception $e) {
            $status = 'error';
        }
    } else {
        $status = 'error';
    }

    return response()->json([
        'status' => $status
    ]);
});

Route::delete('/deleteitem', function (Request $request) {
    $id = $request->input('id');
    if ($id) {
        $query = 'DELETE FROM `lists` WHERE `id` = ?';
        try {
            DB::delete($query, [$id]);
            $status = 'success';
        } catch (Exception $e) {
            $status = 'error';
        }
    } else {
        $status = 'error';
    }

    return response()->json([
        'status' => $status
    ]);
});
