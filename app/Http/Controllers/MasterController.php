<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Campus;
use App\Models\User;
use App\Models\DocuFolder;
use App\Models\Document;

class MasterController extends Controller
{

    public function dashboard()
    {   
        $userCount = User::all();
        $campCount = Campus::all();
        $docuCount = Document::all();

        return view("home.dashboard", compact('campCount', 'userCount','docuCount'));
    }

    // public function drive()
    // {
    //     $users = User::where('role', 'Staff');
    //     $docFolder = DocuFolder::all()->where('folder_category', 'mainfolder');
        
    //     return view("drive.drive", compact('users', 'docFolder'));
    // }
    public function drive()
    {
    $user = auth()->user(); // Get the current authenticated user

    // Filter users based on role
    $users = User::where('role', 'Staff')->get(); 

    // Filter folders based on the user's role
    if (in_array($user->role, ['Administrator', 'Staff', 'Records Officer'])) {
        $docFolder = DocuFolder::where('folder_category', 'mainfolder')->get();
    } elseif ($user->role === 'Staff_reg') {
        $docFolder = DocuFolder::where('folder_category', 'mainfolder')
                               ->where('folder_name', 'En Route')
                               ->get();
    } else {
        $docFolder = collect(); // No folders for other roles
    }

    return view("drive.drive", compact('users', 'docFolder'));
    }

    public function log()
    {
        $users = User::where('role', 'Staff');
        $docFolder = DocuFolder::all()->where('folder_category', 'mainfolder');
        
        return view("logs.log", compact('users', 'docFolder'));
    }

    public function user()
    {
        $camp = Campus::all();

        $user = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('offices', 'users.office_id', '=', 'offices.id')
            ->select('users.id as uid', 'users.*', 'campuses.*','offices.office_abbr','contact_no','users.office_id')
            ->where('role', '!=', 'Staff')
            ->get();
    
        return view("users.ulist", compact('user', 'camp'));
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return redirect()->route('getLogin')->with('success', 'You have been Successfully Logged Out');
        } else {
            return redirect()->route('drive')->with('error', 'No authenticated user to log out');
        }
    }
    
}
