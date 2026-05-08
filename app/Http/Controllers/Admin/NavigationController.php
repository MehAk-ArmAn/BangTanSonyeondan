<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function index()
    {
        return view('admin.navigation.index', [
            'navList' => NavItem::orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active', true);
        NavItem::create($data);
        return back()->with('success', 'Navigation link added.');
    }

    public function update(Request $request, NavItem $navigation)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');
        $navigation->update($data);
        return back()->with('success', 'Navigation link updated.');
    }

    public function destroy(NavItem $navigation)
    {
        $navigation->delete();
        return back()->with('success', 'Navigation link deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
