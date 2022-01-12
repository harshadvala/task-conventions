<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskChat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks = [];
    public $selectedTask = '';
    public $conversations = [];
    public $message = '';
    private $taskObject = null;

    public function render()
    {
        $this->tasks = Task::when(!Auth::user()->is_admin, function ($query) {
            $query->where('user_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();
        if (!$this->selectedTask && $this->tasks->count() > 0) {
            $this->selectedTask = $this->tasks[0]->id;
            $this->taskObject = $this->tasks[0];
        }

        $this->refreshChat();
        return view('livewire.task-list');
    }

    public function selectTask($id)
    {
        $this->selectedTask = $id;

    }

    public function refreshTaskRecord()
    {
        $this->taskObject = Task::find($this->selectedTask);
    }

    public function refreshChat()
    {
        if ($this->selectedTask) {
            $this->conversations = TaskChat::where('task_id', $this->selectedTask)->get();
        } else {
            $this->conversations = [];
        }
    }

    public function sendMessage()
    {
        $toId = Auth::id();
        if (!$this->taskObject) {
            $this->refreshTaskRecord();
        }
        if (Auth::id() == $this->taskObject->user_id) {
            $toId = User::where('is_admin', true)->first()->id;
        } else {
            $toId = $this->taskObject->user_id;
        }
        $taskChat = new TaskChat();
        $taskChat->task_id = $this->selectedTask;
        $taskChat->message = $this->message;
        $taskChat->from_id = Auth::id();
        $taskChat->to_id = $toId;
        $taskChat->save();
        $this->message = '';
    }

    public function deleteTask($id)
    {
        Task::where('id', $id)->delete();
    }
}
