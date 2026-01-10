<?php

namespace App\Http\Controllers;

use App\Leads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'full_name' => 'required',
            'phone' => 'required',
            'note' => 'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->route('home')->with('error', '"Data format error.');
        }

        Leads::create([
            'user_id' => Auth::user()->id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'note' => $request->note,
        ]);

        return redirect()->route('home')->with('success', "Data saved successfully");
    }

    public function update(Request $request, Leads $lead)
    {
        $validate = Validator::make($request->all(), [
            'full_name' => 'required',
            'phone' => 'required',
            'note' => 'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->route('home')->with('error', '"Data format error.');
        }

        $lead->update([
            'user_id' => Auth::user()->id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'note' => $request->note,
        ]);

        $lead->save();
        return redirect()->route('home')->with('success', "Data updated successfully");
    }

    public function delete(Leads $lead)
    {
        if (!$lead) {
            return redirect()->route('home')->with('error', "Data format error.");
        }

        $lead->delete();
        return redirect()->route('home')->with('success', "Data deleted successfully");
    }
}
