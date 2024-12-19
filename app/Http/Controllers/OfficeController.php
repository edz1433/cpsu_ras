<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Office;

class OfficeController extends Controller
{
    public function officeList(){
        $office = Office::all();
        return view('offdept.officelist', compact('office'));
    }
    
    public function officeEdit($id){
        $office = Office::all();
        $officeedit = Office::find($id);
        return view('offdept.officelist', compact('office','officeedit'));
    }


    public function officeDelete($id){
        $office = Office::find($id);
        $office->delete();

        return response()->json([
            'status'=>200,
            'message'=>"Deleted Successfully",
        ]);
    }
}
