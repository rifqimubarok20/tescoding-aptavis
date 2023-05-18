<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();
        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('team.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams',
            'city' => 'required',
        ]);

        Team::create([
            'name' => $request->name,
            'city' => $request->city,
        ]);

        return redirect()->route('team.index')
            ->with('success', 'Tim berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teams = Team::findOrFail($id);
        return view('team.edit', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
        ]);

        $teams = Team::findOrFail($id);
        $teams->name = $request->name;
        $teams->city = $request->city;
        $teams->save();
        return redirect()->route('team.index')
            ->with('success', 'Klub berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        return redirect()->route('team.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
