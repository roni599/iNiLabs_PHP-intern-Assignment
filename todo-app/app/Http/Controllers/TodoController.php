<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function complete()
    {
        $todo = Todo::where('completed', '1')->get();
        return response()->json($todo);
    }
    public function incomplete()
    {
        $todo = Todo::where('completed', '0')->get();
        return response()->json($todo);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::create($validated);
        return response()->json($todo);
    }

    public function status($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            $todo->completed = '1'
        ]);
    }
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo->update($validated);
        return response()->json($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json(null, 204);
    }
}
