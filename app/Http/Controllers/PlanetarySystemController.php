<?php

namespace App\Http\Controllers;

use App\Models\PlanetarySystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Auth;

class PlanetarySystemController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        // pour le moment : 
        $name = "whatever";
        // quand name system implanté dans formulaire d'inscription user :
        //$user_id = Auth::user()->name;
        $x_coord = random_int(1, 999);
        $y_coord = random_int(1, 999);

        $verify = PlanetarySystem::where('x_coord', $x_coord)->where('y_coord', $y_coord)->get();
        if ($verify != "") {

            $planetary_system = new PlanetarySystem();
            $planetary_system->name = $name;
            $planetary_system->x_coord = $x_coord;
            $planetary_system->y_coord = $y_coord;
            $planetary_system->save();

            return Response()->json('Système ' . $planetary_system->name . ' créé !');
        } else {
            $x_coord = $x_coord = (rand(1, 999));
            $y_coord = (rand(1, 999));

            $planetary_system = new PlanetarySystem();
            $planetary_system->name = $request->name;
            $planetary_system->x_coord = $x_coord;
            $planetary_system->y_coord = $y_coord;
            $planetary_system->save();

            return Response()->json('Système ' . $planetary_system->name . ' créé !');
        }
    }

    public function read(Request $request)
    {
        $user_id = Auth::user()->id;
        $showsystem = PlanetarySystem::where('user_id', $user_id)->get();
            return response()->json($showsystem, 200);
        }
    }
    // public function store(Request $request, Localisation $localisation, Map $map, XCoord $x_coord, YCoord $y_coord)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //     ]);

    //     $planetary_system = [
    //         'map' => $map,
    //         'name' => $request->name,
    //         'localisation' => $localisation,
    //         'x_coord' => $x_coord,
    //         'y_coord' => $y_coord,
    //     ];

    //     PlanetarySystem::store([
    //         'map' => $map,
    //         'name' => $request->name,
    //         'localisation' => $localisation,
    //         'x_coord' => $x_coord,
    //         'y_coord' => $y_coord,
    //     ]);

    //     // à arranger plus tard
    //     return redirect('/index')->with('success', '✔️ System successfully created.');
    // }

    public function destroy(PlanetarySystem $planetary_system)
    {
        $planetary_system->delete();

        // à arranger plus tard
        return redirect()->route('index')->with('success', '✔️ System successfully deleted.');;
    }
}