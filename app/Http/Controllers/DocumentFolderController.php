<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\DocuFolder;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Office;
use Illuminate\Support\Facades\Route;

class DocumentFolderController extends Controller
{
    
    public function createFolder(Request $request)
    {
        $request->validate([
            'folderName' => 'required|string|max:255',
            'user_access' => 'required|array',
        ]);
    
        $folderName = $request->input('folderName');
        $folderPath = public_path('Drives/' . $folderName);
    
        if (File::exists($folderPath)) {
            return redirect()->back()->with('error', 'Folder already exists.');
        }
    
        $newFolder = DocuFolder::create([
            'folder_name' => $folderName,
            'folder_category' => 'mainfolder',
            'folder_path' => 'Drives/' . $folderName,
            'user_access' => implode(', ', $request->input('user_access')),
        ]);
    
        File::makeDirectory($folderPath);
    
        return redirect()->back()->with('success', 'Folder created successfully.');
    }
    
    
    public function updateFolder(Request $request)
    {
        $request->validate([
            'fid' => 'required|string|max:255',
            'folderName' => 'required|string|max:255',
            'user_access' => 'required|array', 
        ]);
    
        $folderId = $request->input('fid');
        $newFolderName = $request->input('folderName');
        $newFolderPath = public_path('Drives/' . $newFolderName);
    
        $existingFolder = DocuFolder::find($folderId);
    
        if (!$existingFolder) {
            return redirect()->back()->with('error', 'Folder not found.');
        }
    
        $existingFolderPath = public_path($existingFolder->folder_path);
        $existingFolderName = basename($existingFolderPath);
    
        if ($newFolderName !== $existingFolderName) {
            if (File::exists($newFolderPath)) {
                return redirect()->back()->with('error', 'Folder with the new name already exists.');
            }
    
            $existingFolder->update([
                'folder_name' => $newFolderName,
                'folder_path' => 'Drives/' . $newFolderName,
                'user_access' => implode(', ', $request->input('user_access')), 
            ]);
    
            try {
                File::move($existingFolderPath, $newFolderPath);
                return redirect()->back()->with('success', 'Folder updated successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error renaming folder: ' . $e->getMessage());
            }
        } else {
            if ($existingFolder->user_access !== implode(', ', $request->input('user_access'))) {
                $existingFolder->update([
                    'user_access' => implode(', ', $request->input('user_access')),
                ]);
                return redirect()->back()->with('success', 'Folder updated successfully.');
            }
            return redirect()->back()->with('success', 'Folder name is the same, no changes made.');
        }
    }

    public function subfolder($id)
    {
        $uid = auth()->user()->id;
        $users = User::where('role', 'Staff');
        $folder = DocuFolder::find($id);
        $connFolder = explode(',', $folder->connected_folder);
        $connFolders = DocuFolder::whereIn('id', $connFolder)->get();
        $subfolder = DocuFolder::where('folder_category', 'subfolder')->where('connected_folder', $id)->get();
        if ($folder->folder_category !== "mainfolder") {
            $subfolder = DocuFolder::where('folder_category', 'subfolder')
            ->whereRaw("SUBSTRING_INDEX(connected_folder, ',', -1) = ?", [$id])
            ->get();
        }

        if (!$folder) {
            return abort(404);
        }

        $folderPath = public_path($folder->folder_path);
  
        $documents = Document::select('documents.*', 'users.fname', 'users.lname', 'documents.id AS docid')
        ->where('folder_id', $id)
        ->join('users', 'documents.user_id', '=', 'users.id')
        ->get();
        
        return view('drive.viewSubFolder', compact('users', 'folder', 'subfolder', 'id', 'connFolders', 'documents', 'uid', 'folderPath'));
    }
    
    public function createSubFolder(Request $request, $id)
    {
        $folder = DocuFolder::find($id);
        $request->validate([
            'folderName' => 'required|string|max:255',
            'user_access' => 'required|array',
        ]);
    
        $folderName = $request->input('folderName');
        $folderPath = public_path($folder->folder_path . '/' . $folderName);
    
        if (File::exists($folderPath)) {
            return redirect()->back()->with('error', 'Folder already exists.');
        }
    
        $newFolder = DocuFolder::create([
            'folder_name' => $folderName,
            'folder_category' => 'subfolder',
            'connected_folder' => empty($folder->connected_folder) ? $folder->id : $folder->connected_folder . ',' . $folder->id,
            'folder_path' => $folder->folder_path . '/' . $folderName,
            'user_access' => implode(', ', $request->input('user_access')),
        ]);
    
        File::makeDirectory($folderPath);
    
        return redirect()->back()->with('success', 'Folder created successfully.');
    }

    public function deleteFolder($id)
    {
        $folder = DocuFolder::find($id);
    
        if (!$folder) {
            return response()->json(['error' => 'Folder not found'], 404);
        }
    
        $folderPath = public_path($folder->folder_path);
    
        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        }
    
        $folder->delete();
    
        return response()->json(['success' => 'Folder deleted successfully']);
    }
    
}
