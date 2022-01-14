<?php

namespace App\Http\Controllers;

use App\Models\Land;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandController extends Controller
{
    public function list(Request $req) {
        $sortMethod = "asc";

        if ($req->query("sort") != null) {
            $sortMethod = $req->query("sort");
        }

        return Land::orderBy( "price", $sortMethod)->get();
    }

    public function detail($id) {
        return Land::where("id", $id)->first();
    }

    public function create(Request $req) {
        // Get data from request
        $LandData = json_decode($req->getContent());

        $Land = new Land();

        $Land->photo = $LandData->photo;
        $Land->dimension = $LandData->dimension;
        $Land->sheet = $LandData->sheet;
        $Land->map = $LandData->map;
        $Land->parcel = $LandData->parcel;
        $Land->type = $LandData->type;
        $Land->irrigation = $LandData->irrigation;
        $Land->offer = $LandData->offer;
        $Land->price = $LandData->price;
        $Land->available = $LandData->available;

        $Land->save();

        return response()->json($Land, 201);
    }

    public function modify(Request $req, $id) {
        $Land = Land::where("id", $id)->first();

        // Get data from request
        $LandData = json_decode($req->getContent());

        $Land->photo = $LandData->photo;
        $Land->dimension = $LandData->dimension;
        $Land->sheet = $LandData->sheet;
        $Land->map = $LandData->map;
        $Land->parcel = $LandData->parcel;
        $Land->type = $LandData->type;
        $Land->irrigation = $LandData->irrigation;
        $Land->offer = $LandData->offer;
        $Land->price = $LandData->price;
        $Land->available = $LandData->available;

        $Land->save();

        return response()->json($Land, 200);
    }

    public function destroy($id) {
        return Land::destroy($id);
    }
}
