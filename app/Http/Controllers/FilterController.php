<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Filter;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::withCount('blogs')->orderBy('filter_name')->paginate(10);

        return view('filters.index', compact('filters'));
    }

    public function create()
    {
        return view('filters.create');
    }

    public function store(FilterRequest $request)
    {
        Filter::create($request->validated());

        return redirect()->route('filters.index');
    }

    public function edit(Filter $filter)
    {
        return view('filters.edit', compact('filter'));
    }

    public function update(FilterRequest $request, Filter $filter)
    {
        $filter->update($request->validated());

        return redirect()->route('filters.index');
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();

        return redirect()->route('filters.index');
    }
}
