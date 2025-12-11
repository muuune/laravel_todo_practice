<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyTaskPostRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function show()
    {
        $tasks = Task::all();
        return view('mytask')->with('tasks' , $tasks);
    }

    public function create(MyTaskPostRequest $request): RedirectResponse
    {
        // 受信リクエストは正しかった
        // バリデーション済みデータの取得
        $validated = $request->validated();

        $task = new Task();
        $task->title = $validated['title'];
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
    
    public function update(MyTaskPostRequest $request, $id): RedirectResponse
    {  
        // 受信リクエストは正しかった
        // バリデーション済みデータの取得
        $validated = $request->validated();

        $task = Task::findOrFail($id);
        $task->title = $validated['title'];
        $task->save();

        return redirect()->route('mytask.show');
    }
}
