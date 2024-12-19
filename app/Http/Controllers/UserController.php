<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Campus;

class UserController extends Controller
{

    public function uCreate(Request $request){
        $module = isset($request->module) ? $request->module : '';

        $validator = Validator::make($request->all(), [
            'CampusName'=>'required',
            'FirstName'=>'required',
            'MiddleName'=>'required',
            'LastName'=>'required',
            'Username'=>'required|unique:users',
            'Password'=>'required',
            'Role'=>'required',
            'ContactNo' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        else{
            $password = Hash::make($request->input('Password'));
            //Insert data into database
            $query = User::insert([
                'campus_id'=>$request->input('CampusName'),
                'fname'=>$request->input('FirstName'),
                'mname'=>$request->input('MiddleName'),
                'lname'=>$request->input('LastName'),
                'username'=>$request->input('Username'),
                'password'=>$password,
                'role'=>$request->input('Role'),
                'contact_no'=>$request->input('ContactNo'),
            ]);

            if (!empty($module)) {
                return redirect()->route('drive-account')->with('success', 'User Updated Successfully');
            } else {
                return redirect()->back()->with('success', 'User Updated Successfully');
            } 
        }
    }

    public function uEdit($id){
        $camp = Campus::all();
        $user = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
        ->join('offices', 'users.office_id', '=', 'offices.id')
        ->select('users.id as uid', 'users.*', 'campuses.*','offices.office_abbr','users.office_id','users.contact_no')
        ->where('users.role', '!=', 'Staff')
        ->get();
        $uEdit = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
        ->join('offices', 'users.office_id', '=', 'offices.id')
        ->select('users.id as uid', 'users.*', 'campuses.*','offices.office_abbr','users.office_id','users.contact_no')
        ->where('users.id', $id) 
        ->first();

        return view("users.ulist", compact('uEdit', 'user', 'camp'));
    }

    public function uUpdate(Request $request)
    {
        $module = isset($request->module) ? $request->module : '';
        
        $id = $request->input('uid');
        $validator = Validator::make($request->all(), [
            'CampusName' => 'required',
            'FirstName' => 'required',
            'MiddleName' => 'required',
            'LastName' => 'required',
            'Username' => 'required|unique:users,username,' . $id . ',id',
            'Role' => 'required',
            'ContactNo' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user = User::find($id);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            $user->campus_id = $request->input('CampusName');
            $user->fname = $request->input('FirstName');
            $user->mname = $request->input('MiddleName');
            $user->lname = $request->input('LastName');
            $user->username = $request->input('Username');
            $user->role = $request->input('Role');
            $user->contact_no = $request->input('ContactNo');

            
            if ($request->has('Password')) {
                $user->password = Hash::make($request->input('Password'));
            }

            $user->save();
            if (!empty($module)) {
                return redirect()->route('edit-account', $id)->with('success', 'User Updated Successfully');
            } else {
                return redirect()->back()->with('success', 'User Updated Successfully');
            }
            
        }
    }

    public function uDelete($id){
        $users = User::find($id);
        $users->delete();

        return response()->json([
            'status'=>200,
            'uid'=>$id,
        ]);
    }

}
