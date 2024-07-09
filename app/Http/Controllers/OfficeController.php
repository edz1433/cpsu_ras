<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Office;
use App\Models\Employee;

class OfficeController extends Controller
{
    public function getGuaard()
    {
        if(\Auth::guard('web')->check()) {
            return 'web';
        } elseif(\Auth::guard('employee')->check()) {
            return 'employee';
        }
    }

    public function officeList() {
        $guard = $this->getGuaard();
        $office = Office::leftJoin('cpsupms.employees', 'offices.office_head_id', '=', 'cpsupms.employees.id')
        ->get(['offices.*', 'cpsupms.employees.fname as efname', 'cpsupms.employees.lname as elname']);    
        
        $employee = Employee::all()->where('emp_status', 1);
        
        return view("offdept.officelist", compact('office', 'employee', 'guard'));
    }

    public function officeCreate(Request $request){

        $validator = Validator::make($request->all(), [
            'OfficeName'=>'required',
            'OfficeAbbreviation'=>'required',
            'office_head_id'=>'required',
            'GroupBy'=>'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        else{
            $select = Office::where('office_name', $request->OfficeName)->exists();
            if ($select) {
                return redirect()->back()->with('error', 'Office Already Exist!');
            }
            else
            {
                $query = Office::insert([
                    'office_name'=>$request->input('OfficeName'),
                    'office_abbr'=>$request->input('OfficeAbbreviation'),
                    'office_head_id'=>$request->input('office_head_id'),
                    'group_by'=> '0',
                ]);
                
                return redirect()->back()->with('success', 'Office Added Successfully'); 
            }
        }
    }

    public function officeEdit($id)
    {
        $guard = $this->getGuaard();
        $employee = Employee::all()->where('emp_status', 1);
        $office = Office::leftJoin('cpsupms.employees', 'offices.office_head_id', '=', 'cpsupms.employees.id')
        ->get(['offices.*', 'cpsupms.employees.fname as efname', 'cpsupms.employees.lname as elname']);    

        $offEdit = Office::find($id);

        return view("offdept.officelist", compact('offEdit', 'office', 'employee', 'guard'));
    }

    public function officeUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'OfficeName'=>'required',
            'OfficeAbbreviation'=>'required',
            'office_head_id'=> 'required',
            'GroupBy' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        else{
            $select = Office::where('office_name', $request->OfficeName)->where('id', '!=', $request->oid)->exists();
            if ($select) {
                return redirect()->back()->with('success', 'Office Already Exist!');
            }
            else
            {
                $update = [
                    'office_name'=>$request->input('OfficeName'),
                    'office_abbr'=>$request->input('OfficeAbbreviation'),
                    'office_head_id'=>$request->input('office_head_id'),
                    'group_by'=>'0',
                ];
                DB::table('cpsupms.offices')->where('id', $request->oid)->update($update);

                return redirect()->back()->with('success', 'Office Updated Successfully');
            }
        }
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
