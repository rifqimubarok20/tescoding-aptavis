<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Pertandingan;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matches = Pertandingan::all();
        $teams = Team::all();
        return view('match.index', compact('matches', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('match.tambah', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'home_team_goals' => 'required|integer',
            'away_team_goals' => 'required|integer',
        ]);

        $homeTeam = Team::findOrFail($request->home_team_id);
        $awayTeam = Team::findOrFail($request->away_team_id);

        // Periksa apakah tim A sudah pernah bertanding dengan tim B sebelumnya
        $previousMatch = Pertandingan::where(function ($query) use ($request) {
            $query->where('home_team_id', $request->home_team_id)
                ->where('away_team_id', $request->away_team_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('home_team_id', $request->away_team_id)
                ->where('away_team_id', $request->home_team_id);
        })->exists();

        if ($previousMatch) {
            return redirect()->route('match.index')
                ->with('error', 'Tim tersebut sudah pernah bertanding sebelumnya!');
        }

        $match = Pertandingan::create([
            'home_team_id' => $request->home_team_id,
            'away_team_id' => $request->away_team_id,
            'home_team_goals' => $request->home_team_goals,
            'away_team_goals' => $request->away_team_goals,
        ]);

        // Update statistik tim
        $homeTeam->played++;
        $awayTeam->played++;

        // Goal ke Gawang Lawan
        $homeTeam->goals_for += $request->home_team_goals;
        $homeTeam->goals_against += $request->away_team_goals;
        $awayTeam->goals_for += $request->away_team_goals;
        $awayTeam->goals_against += $request->home_team_goals;

        // Menang, Kalah, Seri
        if ($request->home_team_goals > $request->away_team_goals) {
            $homeTeam->wins++;
            $awayTeam->losses++;

            // Berikan poin
            $homeTeam->points += 3;
        } elseif ($request->home_team_goals < $request->away_team_goals) {
            $homeTeam->losses++;
            $awayTeam->wins++;

            // Berikan poin
            $awayTeam->points += 3;
        } else {
            $homeTeam->draws++;
            $awayTeam->draws++;

            // Berikan poin
            $homeTeam->points += 1;
            $awayTeam->points += 1;
        }

        // Simpan perubahan statistik tim
        $homeTeam->save();
        $awayTeam->save();

        return redirect()->route('klasemen.index')
            ->with('success', 'Pertandingan berhasil ditambahkan!');
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
        $matches = Pertandingan::findOrFail($id);
        $teams = Team::all();
        return view('match.edit', compact('matches', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id',
            'home_team_goals' => 'required|integer',
            'away_team_goals' => 'required|integer',
        ]);
    
        $homeTeam = Team::findOrFail($request->home_team_id);
        $awayTeam = Team::findOrFail($request->away_team_id);
    
        $match = Pertandingan::findOrFail($id);
    
        // Update statistik tim
        $homeTeam->played -= 1;
        $awayTeam->played -= 1;
    
        // Goal ke Gawang Lawan
        $homeTeam->goals_for -= $match->home_team_goals;
        $homeTeam->goals_against -= $match->away_team_goals;
        $awayTeam->goals_for -= $match->away_team_goals;
        $awayTeam->goals_against -= $match->home_team_goals;
    
        // Menang, Kalah, Seri
        if ($match->home_team_goals > $match->away_team_goals) {
            $homeTeam->wins -= 1;
            $awayTeam->losses -= 1;
    
            // Kurangi poin
            $homeTeam->points -= 3;
        } elseif ($match->home_team_goals < $match->away_team_goals) {
            $homeTeam->losses -= 1;
            $awayTeam->wins -= 1;
    
            // Kurangi poin
            $awayTeam->points -= 3;
        } else {
            $homeTeam->draws -= 1;
            $awayTeam->draws -= 1;
    
            // Kurangi poin
            $homeTeam->points -= 1;
            $awayTeam->points -= 1;
        }
    
        // Simpan perubahan statistik tim
        $homeTeam->save();
        $awayTeam->save();
    
        // Update pertandingan
        $match->home_team_id = $request->home_team_id;
        $match->away_team_id = $request->away_team_id;
        $match->home_team_goals = $request->home_team_goals;
        $match->away_team_goals = $request->away_team_goals;
        $match->save();
    
        // Update statistik tim baru
        $homeTeam->played += 1;
        $awayTeam->played += 1;
    
        // Goal ke Gawang Lawan baru
        $homeTeam->goals_for += $request->home_team_goals;
        $homeTeam->goals_against += $request->away_team_goals;
        $awayTeam->goals_for += $request->away_team_goals;
        $awayTeam->goals_against += $request->home_team_goals;
    
        // Menang, Kalah, Seri baru
        if ($request->home_team_goals > $request->away_team_goals) {
            $homeTeam->wins += 1;
            $awayTeam->losses += 1;
    
            // Berikan poin baru
            $homeTeam->points += 3;
        } elseif ($request->home_team_goals < $request->away_team_goals) {
            $homeTeam->losses += 1;
            $awayTeam->wins += 1;
    
            // Berikan poin baru
            $awayTeam->points += 3;
        } else {
            $homeTeam->draws += 1;
            $awayTeam->draws += 1;
    
            // Berikan poin baru
            $homeTeam->points += 1;
            $awayTeam->points += 1;
        }
    
        // Simpan perubahan statistik tim baru
        $homeTeam->save();
        $awayTeam->save();
    
        return redirect()->route('klasemen.index')
            ->with('success', 'Pertandingan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $match = Pertandingan::findOrFail($id);

        // Dapatkan tim-tim yang terlibat dalam pertandingan
        $homeTeam = Team::findOrFail($match->home_team_id);
        $awayTeam = Team::findOrFail($match->away_team_id);

        // Mengurangi statistik tim
        $homeTeam->played--;
        $awayTeam->played--;

        // Mengurangi gol ke gawang lawan
        $homeTeam->goals_for -= $match->home_team_goals;
        $homeTeam->goals_against -= $match->away_team_goals;
        $awayTeam->goals_for -= $match->away_team_goals;
        $awayTeam->goals_against -= $match->home_team_goals;

        // Mengurangi poin
        if ($match->home_team_goals > $match->away_team_goals) {
            $homeTeam->wins--;
            $awayTeam->losses--;

            $homeTeam->points -= 3;
        } elseif ($match->home_team_goals < $match->away_team_goals) {
            $homeTeam->losses--;
            $awayTeam->wins--;

            $awayTeam->points -= 3;
        } else {
            $homeTeam->draws--;
            $awayTeam->draws--;

            $homeTeam->points -= 1;
            $awayTeam->points -= 1;
        }

        // Simpan perubahan statistik tim
        $homeTeam->save();
        $awayTeam->save();

        // Hapus pertandingan
        $match->delete();

        return redirect()->route('klasemen.index')
            ->with('success', 'Pertandingan berhasil dihapus!');
        }
}
