<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campus;

class DriveAccountController extends Controller
{
    public function driveAccount(){
        $camp = Campus::all();
        $users = User::where('role', 'Staff')->get();
        return view("account.account", compact('users', 'camp'));
    }

    public function createAccount(){
        $camp = Campus::all();
        return view("account.create-account", compact('camp'));
    }

    public function editAccount($id){
        $camp = Campus::all();
        $accounts = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
        ->select('users.id as uid', 'users.*', 'campuses.*')
        ->where('users.id', $id) 
        ->first();
        return view("account.edit-account", compact('camp', 'accounts'));
    }
}
