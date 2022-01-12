<?php

namespace App\Http\Controllers;

use App\Mail\TaskDetailMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 *
 */
class TaskController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('tasks.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tasks.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'budget_min' => 'required|integer',
            'budget_max' => 'required|integer',
            'file' => 'mimes:jpg,bmp,png,gif,pdf,doc',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();
        $task->fill($request->except('file'));
        $task->user_id = Auth::id();
        $task->key = Str::random(12);
        $task->save();

        if ($request->file('file')) {
            $file = Storage::put('attachments', $request->file);
            $task->file = $file;
            $task->save();
        }

        $request->session()->flash('created', $task->id);

        Mail::to($task->email)->send(new TaskDetailMail($task));

        return $this->created($request);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function created(Request $request)
    {
        $createId = $request->session()->get('created');
        $task = ($createId) ? Task::find($createId) : null;
        if ($task) {
            return view('tasks.created', ['task' => $task]);
        }

        return Redirect::route('tasks.index');
    }

    public function edit($id)
    {
        return view('tasks.add', ['task' => Task::find($id)]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'budget_min' => 'required|integer',
            'budget_max' => 'required|integer',
            'id' => 'required',
            'file' => 'mimes:jpg,bmp,png,gif,pdf,doc',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $task = Task::find($id);


        if ($request->file('file')) {
            // Remove old File
            if ($task->file) {
                if (Storage::exists($task->file)) {
                    Storage::delete($task->file);
                }
            }

            $file = Storage::put('attachments', $request->file);
            $task->file = $file;
            $task->save();
        }

        $task->fill($request->except('file'));
        $task->save();

        return Redirect::route('tasks.index');
    }
}
