<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    public function index()
    {
        $subtasks = Subtask::paginate(20);
        // for each task_id thats linked to a subtask, get the task, and give it to the view subtasks.index
        $subtasks->load('task');
        return view('subtasks.index', compact('subtasks'));
    }

    public function create()
    {
        $tasks = Task::all();
        return view('subtasks.create', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'status' => 'required|in:open,in uitvoering,voltooid',
            'task_id' => 'required|exists:tasks,id',
        ]);

        // Maak de subtaak aan met de gevalideerde data
        Subtask::create($validated);

        return redirect()->route('subtasks', $validated['task_id'])->with('success', 'Subtask created successfully.');
    }

    public function show(Subtask $subtask)
    {
        return view('subtasks.show', compact('subtask'));
    }

    public function edit(Subtask $subtask)
    {
        $tasks = Task::all();
        return view('subtasks.edit', compact('subtask', 'tasks'));
    }

    public function update(Request $request, Subtask $subtask)
    {
        $subtask->update($request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'nullable|string',
            'status' => 'required|in:open,in uitvoering,voltooid',
        ]));

        return redirect()->route('subtasks', $subtask->task_id)->with('success', 'Subtask updated successfully.');
    }

    public function destroy(Subtask $subtask)
    {
        $subtask->delete();

        return redirect()->route('subtasks', $subtask->task_id)->with('success', 'Subtask deleted successfully.');
    }
}
