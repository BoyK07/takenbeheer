<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::paginate(20);
        return view('tasks.index', compact('tasks'));
    }

    public function create() 
    {
        $users = User::all(); 
        return view('tasks.create', compact('users'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'status' => 'required|in:open,in uitvoering,voltooid',
            'vervaldatum' => 'nullable|date',
            'prioriteit' => 'required|in:laag,normaal,hoog',
        ]);

        $task = Task::create($validated);
        $task->users()->attach($request->gebruikers); 

        return redirect()->route('tasks')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::all(); // Haal alle gebruikers op
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'status' => 'required|in:open,in uitvoering,voltooid',
            'vervaldatum' => 'nullable|date',
            'prioriteit' => 'required|in:laag,normaal,hoog',
        ]);

        $task->update($validated);
        $task->users()->sync($request->gebruikers); 

        return redirect()->route('tasks')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks')->with('success', 'Task deleted successfully.');
    }

    
    public function assignUser(Request $request, Task $task)
    {
        $user = User::findOrFail($request->user_id);
        $task->users()->attach($user);

        return redirect()->route('tasks', $task)->with('success', 'User assigned to task successfully.');
    }
}
