<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        return Label::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:labels',
            'color' => 'required|string',
        ]);

        return Label::create($request->all());
    }

    public function show(Label $label)
    {
        return $label;
    }

    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name' => 'string|unique:labels,name,' . $label->id,
            'color' => 'string',
        ]);

        $label->update($request->all());
        return $label;
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return response()->json(null, 204);
    }
}
