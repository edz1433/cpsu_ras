<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocuFolder; 
use App\Models\Document;
use App\Models\Log;

class DocumentController extends Controller
{
    public function storeFile(Request $request, $id)
    {     
      
        $process = isset($request->process) ? $request->process : '';

        // $request->validate([
        //     'file' => 'required',
        // ]);
    
        $user_id = auth()->user()->id;
      
        $folder = DocuFolder::find($id);
    
        $file = $request->file('file');
  
        $originalFileName = $file->getClientOriginalName();
    
        do {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    
            //$fileName = $randomNumber . '_' . $originalFileName;
            $fileName = $randomNumber . '_' . $originalFileName;
    
            $filePath = public_path($folder->folder_path . '/' . $fileName);
        } while (file_exists($filePath));
    
        $document = Document::create([
            'user_id' => $user_id,
            'folder_id' => $id,
            'file' => $fileName,
            'file_ext' => $file->getClientOriginalExtension(),
            // 'doc_stat' => 'en route',
        ]);
    
        $file->move(public_path($folder->folder_path), $fileName);

        Log::create([
            'user_id' => $user_id,
            'file_id' => $document->id,
            'action' => 1, 
            'prev_file' => $originalFileName,
            'new_file' => null,
        ]);
    
        if(!empty($process)){
            return redirect()->back()->with('success', 'File uploaded successfully.');
        }else{
            return response()->json(['success' => 'File uploaded successfully.']);
        }
    } 


    public function updateFile(Request $request)
    {
        $request->validate([
            'file_id' => 'required|string', 
            'file_name' => 'required|string', 
        ]);
        
        $fileId = $request->file_id;

        $document = Document::find($fileId);
    
        if (!$document) {
            return response()->json(['error' => 'File not found.'], 404);
        }
    
        $oldFileName = $document->file;
        $newFileName = $request->file_name;
    
        $folder = DocuFolder::find($document->folder_id);
        $newFilePath = public_path($folder->folder_path . '/' . $newFileName);
    
        do {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $newFileName = $randomNumber . '_' . $newFileName.'.'.$document->file_ext;
            $newFilePath = public_path($folder->folder_path . '/' . $newFileName);
        } while (file_exists($newFilePath));
    
        $existingFilePath = public_path($folder->folder_path . '/' . $document->file);
        if (file_exists($existingFilePath)) {
            rename($existingFilePath, $newFilePath);
        }
    
        $document->update([
            'file' => $newFileName,
        ]);

        Log::create([
            'user_id' => auth()->user()->id,
            'file_id' => $document->id,
            'action' => 2,
            'prev_file' => $oldFileName,
            'new_file' => $newFileName,
        ]);
    
        return redirect()->back()->with('success', 'File name updated successfully.');

    }    

    public function deleteFile($id)
    {
        $document = Document::find($id);
    
        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }
    
        $folder = DocuFolder::find($document->folder_id);
    
        if (!$folder) {
            return response()->json(['error' => 'Folder not found'], 404);
        }
    
        $filePath = $folder->folder_path . '/' . $document->file;
    
        if (file_exists($filePath)) {
            unlink($filePath);
    
            Log::create([
                'user_id' => auth()->user()->id,
                'file_id' => $document->id,
                'action' => 3,
                'prev_file' => $document->file,
                'new_file' => null,
            ]);
    
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    
        $document->delete();
    
        return response()->json(['success' => 'File deleted successfully']);
    }
  
}
