<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{

    public function index()
    {
        $spaces = Space::all();
        return view('spaces.index', compact('spaces'));

    }

    public function store(Request $request)
    {
        $space = new Space;
        $space->numero_space = $request->num_space;
        $space->tipo_space = $request->tipo_space;
        $space->estado = $request->estado;
        $space->save();
        return redirect()->route('spaces.index');
    }

    public function edit(string $id)
    {
        $space = Space::find($id);
        return view('spaces.edit', compact('space'));
    }

    public function update(Request $request, string $id)
    {
        $space = Space::find($id);
        $space->numero_space = $request->num_space;
        $space->tipo_space = $request->tipo_space;
        $space->estado = $request->estado;
        $space->save();
        return redirect()->route('spaces.index');  
    }

    public function destroy(string $id)
    {
        $space = Space::find($id);
        $space->delete();
        return redirect()->route('spaces.index');
    }
}
