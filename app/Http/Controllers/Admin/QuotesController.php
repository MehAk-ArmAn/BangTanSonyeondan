<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index()
    {
        return view('admin.quotes.index', [
            'quotesList' => Quote::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active', true);
        Quote::create($data);
        return back()->with('success', 'Quote added.');
    }

    public function update(Request $request, Quote $quote)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');
        $quote->update($data);
        return back()->with('success', 'Quote updated.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return back()->with('success', 'Quote deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'quote' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
