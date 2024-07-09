<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Campus;
use App\Models\User;
use App\Models\DocuFolder;

class MasterController extends Controller
{

    public function dashboard()
    {
        $userCount = User::all();
        $campCount = Campus::all();

        return view("home.dashboard", compact('campCount', 'userCount'));
    }

    public function drive()
    {
        $users = User::where('role', 'Staff');
        $docFolder = DocuFolder::all()->where('folder_category', 'mainfolder');
        
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

        $user = User::join('cpsupms.campuses', 'users.campus_id', '=', 'campuses.id')
            ->select('users.id as uid', 'users.*', 'campuses.*')
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
