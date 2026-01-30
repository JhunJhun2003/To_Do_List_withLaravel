<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::simplePaginate(5);

        return view('home', compact('todos'));
    }

    public function addtask()
    {
        return view('component.addtask');
    }

    public function storetask(Request $request)
    {
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('home');
    }

    public function edittask(Request $request, $id)
    {
        $todo = Todo::find($id);
        return view('component.edittask', compact('todo'));
    }

    public function updatedtask(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->done = $request->done ?? 0;
        $todo->save();

        return redirect()->route('home');
    }
}
