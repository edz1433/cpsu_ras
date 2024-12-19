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
                        <li class="breadcrumb-item">Account</li>
                    </ol> 
                </nav>
                <div class="card-body">
                    <div class="row">
                        @if(auth()->user()->role != "Staff")
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>Full Name</th>
                                            <th>Username</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($users as $user)
                                            <tr id="tr-{{ $user->id }}">
                                                <td class="text-center" width="30">{{ $no++ }}</td>
                                                <td>{{ strtoupper($user->fname) }} {{ strtoupper($user->lname) }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td width="50">
                                                    <div class='d-flex align-items-center'>
                                                        <a href="{{ route('edit-account', $user->id) }}" class='btn btn-info btn-xs user_edit mr-1' >
                                                            <i class='fas fa-exclamation-circle' ></i>
                                                        </a>
                                                        <button value="{{ $user->id }}" class="btn btn-danger btn-xs users-delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div> 
                                                </td>
                                            </tr>
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
@endsection