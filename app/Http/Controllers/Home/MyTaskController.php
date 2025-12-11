<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function show()
    {
        $tasks = Task::all();
        return view('mytask')->with('tasks' , $tasks);
    }

    public function create(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
        ];

        $request->validate($rules);

        $task = new Task();
        $task->title = $request->title;
        $task->save();

        return redirect()->route('mytask.show');
    }

    public function destroy(Request $request)
    {
        Task::where('id', $request->id)->delete();

        return redirect()->route('mytask.show');
    } 

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit-mytask')->with('task', $task);
    }
    
    public function update(Request $request, $id)
    {  
        $rules = [
        'title' => 'required|string|max:255',
        ];

        $request->validate($rules);

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->save();

        return redirect()->route('mytask.show');
    }
}
