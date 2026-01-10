<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'lead_id' => 'required',
            'title' => 'required',
            'due_at' => 'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->route('home')->with('error', "Data format error.");
        }

        Tasks::create([
            'lead_id' => $request->lead_id,
            'title' => $request->title,
            'due_at' => $request->due_at,
            'is_done' => '0'
        ]);

        return redirect()->route('home')->with('success', "Data saved successfully");
    }

    public function update(Request $request, Tasks $task)
    {
        $validate = Validator::make($request->all(), [
            'lead_id' => 'required',
            'title' => 'required',
            'due_at' => 'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->route('home')->with('error', "Data format error.");
        }

        $task->update([
            'lead_id' => $request->lead_id,
            'title' => $request->title,
            'due_at' => $request->due_at,
            'is_done' => '0'
        ]);

        $task->save();

        return redirect()->route('home')->with('success', "Data updated successfully");
    }

    public function delete(Tasks $task)
    {
        if (!$task) {
            return redirect()->route('home')->with('error', "Data format error.");
        }

        $task->delete();
        return redirect()->route('home')->with('success', "Data deleted successfully");
    }
}
