<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'folder_id', 'file', 'file_ext', 'doc_stat'];

    public function folder()
{
    return $this->belongsTo(DocuFolder::class, 'folder_id');
}

}

