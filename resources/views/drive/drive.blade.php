@extends('layouts.master')

@section('body')
<link rel="stylesheet" href="{{ asset('css/folder.css') }}">
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            @include('drive.submenu')
        </div>
        @include('drive.modals')
        <div class="col-lg-10">
            <div class="card card-success card-outline">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('drive') }}">Drive</a></li>
                        <li class="breadcrumb-item">My Drive</li>
                    </ol> 
                </nav>
                <div class="card-body folder-grid">
                    @php
                        $userid =  auth()->user()->id;
                        $isAdmin = auth()->user()->hasRole('Administrator'); // Assuming you are using roles
                    @endphp
                
                    @forelse ($docFolder as $folder) 
                        @php 
                            $userarray = explode(',', $folder->user_access); 
                            $checkaccess = !in_array($userid, $userarray);
                            
                            $finalcond = $checkaccess && $folder->user_access != "All"&& !$isAdmin; 
                        @endphp
            
                        <div class="@if($finalcond) folder-items @else folder-item @endif;" id="folder-{{ $folder->id }}">
                            <a href="{{ route('sub-folder', $folder->id) }}" style="pointer-events: @if($finalcond) none @endif;">
                                <i class="folder-icon fas"></i>
                                @if($finalcond)
                                    <i class="fas fa-lock fa-2x" style="margin-left: -25px; color: rgb(255, 255, 255); box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2);"></i>
                                @endif
                                <span class="folder-name">{{ $folder->folder_name }}</span>
                            </a>
                           {{--  <!-- edit folder -->
                            @if(auth()->user()->role !== "All")
                                <div class="folder-options" @if($folder->folder_name == "Archive" && auth()->user()->role != "Administrator") hidden @endif>
                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v" id="folderOptionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu" aria-labelledby="folderOptionsDropdown">
                                            <a class="dropdown-item" data-toggle="modal" data-target="#editFolderModal" onclick="editFolder({{ $folder->id }}, '{{$folder->folder_name}}')">Edit</a>
                                            <button class="dropdown-item" onclick="confirmDelete({{ $folder->id }})">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                            <!-- Edit Folder -->
                            @if(auth()->user()->role !== "All")
                            <div class="folder-options"
                                @if($folder->folder_name == "Archive" && auth()->user()->role != "Administrator") hidden @endif>
                                
                                <!-- Check for roles that can access the Edit/Delete menu -->
                                @if(in_array(auth()->user()->role, ['Administrator', 'Staff', 'Records Officer']))
                                <div class="dropdown">
                                    <i class="fas fa-ellipsis-v" id="folderOptionsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu" aria-labelledby="folderOptionsDropdown">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#editFolderModal"
                                        onclick="editFolder({{ $folder->id }}, '{{$folder->folder_name}}')">Edit</a>
                                        <button class="dropdown-item" onclick="confirmDelete({{ $folder->id }})">Delete</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    @empty
                        <div class="no-folders">No folders found..</div>
                    @endforelse
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection
