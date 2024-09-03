<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoModel;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $todolist = Auth::user()->todos;
        return view('todo', compact('todolist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|max:255',
        ]);

        TodoModel::create([
            'user_id' => Auth::id(),
            'kegiatan' => $request->kegiatan,
            
        ]);

        return redirect()->route('home');
    }

    public function markAsCompleted($id)
    {
        $todo = TodoModel::where('idkegiatan',$id);
        $todo->update(['completed' => true]);

        return redirect()->route('home');
    }

    public function markAsUncompleted($id)
    {
        $todo = TodoModel::where('idkegiatan',$id);
        $todo->update(['completed' => false]);

        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $todo = TodoModel::findOrFail($id);
        $todo->delete();

        return redirect()->route('home');
    }
}
