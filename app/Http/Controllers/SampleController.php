<?php

namespace App\Http\Controllers;
use App\Models\Sample;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function readSample(){
        $samples = Sample::all();
        // dd($samples);
        return view('samples.list', compact('samples'));
    }

    public function createSample(Request $request){
        Sample::create([
            'column1' => $request->column1,
            'column2' => $request->column2,
        ]);

        // return redirect()->back()->with('success', 'sadasdasdasdasd');

        return redirect()->route('sam');
    }
    
}
