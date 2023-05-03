<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todos = Todo::paginate(5);
        $totalTodos = Todo::count();

        return view('todo',compact('todos', 'totalTodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //
     $validator = Validator::make($request->all(), [
         'title' => 'required',
     ]);

     if ($validator->fails())
     {
         return redirect()->route('todos.index')->withErrors($validator);
     }

    Todo::create([
        
        'title'=>$title = $request->get('title')
     ]);
     

            return redirect()->route('todos.index')->with('success',$title . ' inserted');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $todo=Todo::where('id',$id)->first();
        return view('edit_todo',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('todos.edit',['todo'=>$id])->withErrors($validator);
        }



        $todo=Todo::where('id',$id)->first();
        $todo->title=$request->get('title');
        $todo->is_completed=$request->get('is_completed');
        $todo->save();
        $title=$request->get('title');

        return redirect()->route('todos.index')->with('success',$title . ' Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        $todo = Todo::findOrFail($id); // récupère le Todo
        $title = $todo->title; // récupère le titre
        $todo->delete(); // supprime le Todo
        return redirect()->route('todos.index')->with('success',$title . ' Deleted Todo');
    }
}
