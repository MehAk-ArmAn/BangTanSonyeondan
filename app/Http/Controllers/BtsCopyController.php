<?php

namespace App\Http\Controllers;

use App\Models\BtsCopy;  // Model that talks to the DB table
use Illuminate\Http\Request;  // Used to read form inputs
use Illuminate\Validation\Rule; // allows custom stuff validation "rules" like Rule::unique('bts_copies')->where(...)
use Illuminate\Support\Str; // optional, for string checks

class BtsCopyController extends Controller
{
    // Shows the create form page
    public function create()
    {
        // Return the Blade view file:
        // resources/views/bts_copies/create.blade.php
        return view('bts_copies.create');
    }

    // Saves form data into DB
    public function store(Request $request)
    {

        // 1) VALIDATE INPUTS
        // If validation fails, Laravel automatically sends user back
        // and fills $errors in Blade file.
        $validated = $request->validate([
            'bts_name' => ['required', 'string', 'max:255'],
            'copy_extra_name' => ['nullable', 'string', 'max:255'],
            'copy_title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bts_copies')->where('bts_name', $request->bts_name), // checks DB for duplicates PER MEMBER
                function($attribute, $value, $fail) use ($request) {
                    if (!Str::contains($value, $request->bts_name)) {
                        $fail("😤 The title must include the selected BTS member ({$request->bts_name}).");
                    }
                },
            ],
            'description' => ['nullable', 'string', 'max:5000'],
        ], [
            'copy_title.unique' => '😤 This BTS copy already exists. Stop trying to clone it.',
        ]);


        // 2) SAVE INTO DATABASE
        // This uses the model to insert a new row into `bts_copies` table
        BtsCopy::create($validated);

        // 3) REDIRECT BACK WITH A SUCCESS MESSAGE
        // with('success', ...) stores a one-time message in session
        return redirect()
            ->route('bts_copies.create')
            ->with('success', '✅ BTS Copy saved successfully!');
    }   

    // (Optional) Shows list of all saved copies
    public function index()
    {
        // latest() means newest first (ORDER BY created_at DESC)
        $copies = \App\Models\BtsCopy::latest()->get();

        // Send $copies to view as a variable
        return view('bts_copies.index', compact('copies'));
    }

    // Show edit form
    public function edit($id)
    {
        $copy = BtsCopy::findOrFail($id); // find copy or 404

        return view('bts_copies.edit', compact('copy')); // send to edit view
    }

    // Update existing copy
    public function update(Request $request, $id)
    {
        $copy = BtsCopy::findOrFail($id); // get record

        $validated = $request->validate([
            'bts_name' => ['required', 'string', 'max:255'],
            'copy_extra_name' => ['nullable', 'string', 'max:255'],
            'copy_title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bts_copies')
                    ->where('bts_name', $request->bts_name)
                    ->ignore($copy->id), // ignore current record
                function($attribute, $value, $fail) use ($request) {
                    if (!Str::contains($value, $request->bts_name)) {
                        $fail("Title must include {$request->bts_name}");
                    }
                },
            ],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $copy->update($validated); // update DB

        return redirect()
            ->route('bts_copies.index')
            ->with('success', 'Copy updated successfully!');
    }

    // Delete a copy
    public function destroy($id)
    {
        $copy = BtsCopy::findOrFail($id); // find record
        $copy->delete(); // remove from DB

        return redirect()
            ->route('bts_copies.index')
            ->with('success', 'Copy deleted successfully!');
    }

}
