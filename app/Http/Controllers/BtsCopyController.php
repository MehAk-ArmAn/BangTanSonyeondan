<?php

namespace App\Http\Controllers;

use App\Models\BtsCopy;
use Illuminate\Http\Request;

class BtsCopyController extends Controller
{
    private array $memberNames = [
        'Kim Namjoon', 'Kim Seokjin', 'Min Yoongi', 'Jung Hoseok', 'Park Jimin', 'Kim Taehyung', 'Jeon Jungkook',
    ];

    public function index()
    {
        return view('bts_copies.index', ['copies' => BtsCopy::latest()->get()]);
    }

    public function create()
    {
        return view('bts_copies.create', ['memberNames' => $this->memberNames]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        BtsCopy::create($data);

        return redirect()->route('bts_copies.index')->with('success', 'BTS copy saved successfully.');
    }

    public function edit(BtsCopy $btsCopy)
    {
        return view('bts_copies.edit', ['btsCopy' => $btsCopy, 'memberNames' => $this->memberNames]);
    }

    public function update(Request $request, BtsCopy $btsCopy)
    {
        $data = $this->validateData($request, $btsCopy->id);
        $btsCopy->update($data);

        return redirect()->route('bts_copies.index')->with('success', 'BTS copy updated successfully.');
    }

    public function destroy(BtsCopy $btsCopy)
    {
        $btsCopy->delete();

        return redirect()->route('bts_copies.index')->with('success', 'BTS copy deleted successfully.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueRule = 'unique:bts_copies,copy_title';
        if ($ignoreId) {
            $uniqueRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'bts_name' => ['required', 'string', 'max:120'],
            'copy_extra_name' => ['nullable', 'string', 'max:120'],
            'copy_title' => ['required', 'string', 'max:200', $uniqueRule],
            'description' => ['nullable', 'string'],
        ], [
            'copy_title.unique' => 'This BTS copy already exists.',
        ]);
    }
}
