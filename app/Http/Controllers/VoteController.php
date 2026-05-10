<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $members = DB::table('members')
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $voteStats = DB::table('votes')
            ->join('members', 'votes.member_id', '=', 'members.id')
            ->select(
                DB::raw("COALESCE(NULLIF(members.stage_name, ''), NULLIF(members.nickname, ''), members.name) as member_name"),
                DB::raw('COUNT(votes.id) as total')
            )
            ->groupBy('members.id', 'members.stage_name', 'members.nickname', 'members.name')
            ->orderByDesc('total')
            ->get();

        $hasVoted = Auth::check()
            ? DB::table('votes')->where('user_id', Auth::id())->exists()
            : false;

        return view('vote', compact('members', 'voteStats', 'hasVoted'));
    }

    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first to vote.');
        }

        $request->validate([
            'member_id' => ['required', 'exists:members,id'],
        ]);

        $alreadyVoted = DB::table('votes')
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You already voted once. One ARMY, one vote only.');
        }

        DB::table('votes')->insert([
            'user_id' => Auth::id(),
            'member_id' => $request->member_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your vote has been submitted. Borahae!');
    }
}
