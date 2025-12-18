<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MyTaskPostRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Task;

class MyTaskController extends Controller
{
    public function show(Request $request)
    {
        $query = Task::query();

        // 絞り込み（filter_statusが送られてきた場合）
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // 検索キーワードが入力された場合
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 並び順の指定
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'title_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('id', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('id', 'asc');
                    break;
            }
        }

        $tasks = $query->get();

        return view('mytask')->with('tasks', $tasks);
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

    public function updateStatus($id)
    {
        $task = Task::findOrFail($id);
        // 現在のstatusを反転させる
        $task->status = !$task->status;
        $task->save();

        return redirect()->route('mytask.show');
    }
}
