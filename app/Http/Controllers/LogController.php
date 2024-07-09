<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function logs(){
        $logs = Log::select("logs.*", 'users.fname', 'users.lname', 'documents.folder_id')
        ->join('users', 'logs.user_id', '=', 'users.id')
        ->leftjoin('documents', 'logs.file_id', '=', 'documents.id')
        ->get();
        return view("logs.log", compact('logs'));
    }
}
