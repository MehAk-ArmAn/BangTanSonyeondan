<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;

class VotesController extends Controller
{
    public function index()
    {
        return view('admin.votes.index', [
            'voteStats' => Vote::selectRaw('member_name, count(*) as total')
                ->groupBy('member_name')
                ->orderByDesc('total')
                ->get(),
        ]);
    }
}
