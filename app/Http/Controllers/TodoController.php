<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    function index()
    {
        $todos = Todo::all();
        return view('home' ,compact('todos'));
    }

    function addtask()
    {
        return view('component.addtask');
    }

    function storetask(Request $request)
    {
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();
        return redirect()->route('home');
    }
}
