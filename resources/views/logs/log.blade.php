@extends('layouts.master')

@section('body')
@php
    $current_route=request()->route()->getName();
@endphp
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            @include('drive.submenu')
        </div>
        <div class="col-lg-10">
            <div class="card card-success card-outline">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('drive') }}">Drive</a></li>
                        <li class="breadcrumb-item">Logs</li>
                    </ol> 
                </nav>
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->role != 'Staff')
                        <div class="col-12">
                            <div class="table-responsive"  style="max-height: 400px; overflow-y: auto;">
                                <table class="table table" id="table-logs">
                                    <thead>
                                        <tr>
                                            <th>logs</th>
                                            <th>Date Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $log)
                                            @if($log->action == 1)
                                            <tr>
                                                <td>
                                                    <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                                    <span class="text-success"><b>uploaded</b></span> a file 
                                                    <span class="text-info"><a href="{{ isset($log->folder_id) ? route('sub-folder', ['id' => $log->folder_id]) : '' }}" style="text-decoration: none; color: inherit;"><b>{{ $log->prev_file }}</b></a></span>
                                                </td>
                                                <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                            </tr>
                                            @endif
                                            @if($log->action == 2)
                                            <tr>
                                                <td>
                                                    <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                                    <span class="text-warning"><b>renamed</b></span>  the file 
                                                    <span class="text-info"><b>{{ $log->prev_file }}</b></span> to 
                                                    <span class="text-info"><a href="{{ isset($log->folder_id) ? route('sub-folder', ['id' => $log->folder_id]) : '' }}" style="text-decoration: none; color: inherit;"><b>{{ $log->new_file }}</b></a> </span>
                                                </td>
                                                <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                            </tr>
                                            @endif

                                            @if($log->action == 3)
                                            <tr>
                                                <td>
                                                    <span class="user"><b>{{ ucwords(strtolower($log->fname)) }} {{ ucwords(strtolower($log->lname)) }}</b></span> 
                                                    <span class="text-danger"><b>deleted</b></span>  the file 
                                                    <span class="text-info"><b>{{ $log->prev_file }}</b></span>
                                                </td>
                                                <td class="timestamp">{{ $log->created_at->format('F j, Y, g:i A') }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@include('account.modals')
<!-- /End Modal -->
@endsection