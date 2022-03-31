<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index()
    {
        return response()->json(Todo::get());
    }

    public function store(Request $request)
    {
        $Todo = Todo::create($request->all());
        return response()->json($Todo);
    }

   

    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return response()->json($todo);
    }
    
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json("Success");
    }
}
