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


Route::get('/lists', function () {
    $lists = DB::select('SELECT * FROM `lists`');

    return response()->json($lists);
});

Route::delete('/deletelist', function (Request $request) {
    $list_id = $request->input('list_id');
    if ($list_id) {
        $query = 'DELETE FROM `lists` WHERE `list_id` = ?';
        try {
            DB::delete($query, [$list_id]);
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

Route::post('/addlist', function (Request $request) {
    $list_name = $request->input('list_name');
    $description = $request->input('description');
    if ($list_name) {
        $query = 'INSERT INTO `lists` (`list_name`, `description`) VALUES (?, ?)';
        try {
            DB::insert($query, [$list_name, $description]);
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

Route::get('/list/{list_id}', function ($list_id) {

    $list = DB::select('SELECT * FROM `items` JOIN `lists` ON `items`.`list_id` = `lists`.`list_id` WHERE `items`.`list_id` = ?', [$list_id]);

    return response()->json($list);
});

Route::post('/additem', function (Request $request) {
    $list_id = $request->input('list_id');
    $item = $request->input('item');
    $datetime = date('Y-m-d H:i:s');

    if ($list_id) {
        $query = 'INSERT INTO `items` (`list_id`, `item`, `created`, `modified`) VALUES (?, ?, ?, ?)';
        try {
            DB::insert($query, [$list_id, $item, $datetime, $datetime]);
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
        $query = 'DELETE FROM `items` WHERE `id` = ?';
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

Route::put('/updateitem', function (Request $request) {
    $id = $request->input('id');
    $newItem = $request->input('newItem');
    $datetime = date('Y-m-d H:i:s');

    if ($id) {
        $query = 'UPDATE `items` SET item = ?, modified = ? WHERE `id` = ?';
        try {
            DB::delete($query, [$newItem, $datetime, $id]);
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