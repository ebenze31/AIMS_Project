<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Middle_price_car;
use DB;

class Brand_middle_price_carsController extends Controller
{
    public function getBrand()
    {
        $car_brand = Middle_price_car::select('brand')
            ->orderBy('brand')
            ->where('type', "car")
            ->groupBy('brand')
            ->get();

        return $car_brand;
    }

    public function getModel($car_brand)
    {
        $car_model = Middle_price_car::select('model')
        	->orderBy('model')
        	->where('type', '=',"car" )
            ->where('brand', $car_brand )
            ->groupBy('model')
            ->get();
        return $car_model;
    }

    // motorcycles

    public function getMotorBrand()
    {
        $motor_brand = Middle_price_car::select('brand')
            ->orderBy('brand')
            ->where('type', "motorcycle")
            ->groupBy('brand')
            ->get();

        return $motor_brand;
    }
    public function getMotorModel($motor_brand)
    {
        $motor_model = Middle_price_car::select('model')
        	->orderBy('model')
        	->where('type', '=',"motorcycle" )
            ->where('brand', $motor_brand )
            ->groupBy('model')
            ->get();

        return $motor_model;
    }

}
