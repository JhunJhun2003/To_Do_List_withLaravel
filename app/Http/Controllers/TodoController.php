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

    // to go edit page
    public function edittask(Request $request, $id)
    {
        $todo = Todo::find($id);

        return view('component.edittask', compact('todo'));
    }

    // to update task
    public function updatedtask(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->done = $request->done ?? 0;
        $todo->save();

        return redirect()->route('home');
    }

    public function deletetask($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('home');
    }

    // public function toggle(Todo $todo)
    // {
    //     $todo->done = !$todo->done;
    //     $todo->save();

    //     return redirect()->route('home');
    // }
    public function toggle(Todo $todo)
    {
        // If it was 1 (true), it becomes 0 (false) and vice-versa
        $todo->update([
            'done' => ! $todo->done,
        ]);

        $todo->save();
        return response()->json(['success' => true, 'done' => $todo->done]);
    }

    public function searchtitle(Request $request)
    {
        $search = $request->input('search');
        $todos = Todo::where('title', 'like', '%' . $search . '%')->simplePaginate(5);

        return view('home', compact('todos'));
    }
}
