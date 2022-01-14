<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandController;

Route::get("/lands", [LandController::class, "list"]);
Route::get("/lands/{id}", [LandController::class, "detail"]);
Route::post("/lands", [LandController::class, "create"]);
Route::put("/lands/{id}", [LandController::class, "modify"]);
Route::delete("/lands/{id}", [LandController::class, "destroy"]);
