<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    public function index()
    {
        $markers = $this->map();
        return view('index', ['markers' =>$markers]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'city' => 'required'
        ]);

        $city = $data['city'];
        $key = config('services.owm.key');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=".$city."&lang=es"."&appid=7eb0b52383996a417af962dbd38fad6a")
            ->json();
        if ($response['cod'] == "200") {

            $weather = $response['weather'][0]['description'];
            $main = $response['weather'][0]['main'];
            $wet = $response['main']['humidity'] ;
            $name = $response['name'];
            $country = $response['sys']['country'];
            $ok = $response['cod'];
            $lon =$response['coord']['lon'];
            $lat =$response['coord']['lat'];
            $data = new City();
            $data->cityName = $name;
            $data->contryName =$country;
            $data->lat = $lat;
            $data->lon = $lon;
            $data->wet = $wet;
            $data->save();
            $markers = $this->map();
            return view('index', compact('weather', 'main', 'wet', 'name', 'country', 'ok','markers'));
        } else {
            $notFound = true;
            return view('index', compact('notFound'));
        }
    }

    public function map()   
    {    
        $markers = City::select('lat','lon','cityName','wet')->get();
        return  json_encode($markers);
    }

    public function history()
    {
        $data = City::all(); 
        return view('history',compact('data'));
    }
}
