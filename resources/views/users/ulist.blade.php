@extends('layouts.master')

@section('body')

<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-3">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> {{ (request()->is('users/ulist')) ? "Add" :  "Edit" }}
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ (request()->is('users/ulist/*')) ? route('uCreate') : route('uUpdate') }}" method="POST">
                        @csrf
                         <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Department:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" name="Officeid" value="{{ (isset($uEdit)) ? $uEdit->office_id : '' }}">
                                        <input type="text" name="Officeabbr" class="form-control" value="{{ (isset($uEdit)) ? $uEdit->office_abbr : '' }}" autocomplete="off">
                                    </div>
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left LastName_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Last Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="hidden" name="uid" value="{{ (isset($uEdit)) ? $uEdit->uid : '' }}">
                                        <input type="text" name="LastName" value="{{ (isset($uEdit)) ? $uEdit->lname : '' }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control" autocomplete="off">
                                    </div>
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left LastName_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">First Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="FirstName" value="{{ (isset($uEdit)) ? $uEdit->fname : '' }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control" autocomplete="off">
                                    </div>    
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left FirstName_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Middle Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="MiddleName" value="{{ (isset($uEdit)) ? $uEdit->mname : '' }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control" autocomplete="off">
                                    </div>
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left MiddleName_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Contact no:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-address-book"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="ContactNo" value="{{ (isset($uEdit)) ? $uEdit->contact_no : '' }}" placeholder="Enter Contact number" class="form-control" autocomplete="off">
                                    </div>    
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left Username_error"></span>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Username:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="Username" value="{{ (isset($uEdit)) ? $uEdit->username : '' }}" placeholder="Enter Username" class="form-control" autocomplete="off">
                                    </div>    
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left Username_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Password:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="Password" value="{{ (isset($uEdit)) ? "******" : '' }}" placeholder="*****" class="form-control" autocomplete="off">
                                    </div>    
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left Password_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Campus:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker"></i>
                                            </span>
                                        </div>
                                        <select class="form-control select2bs4" name="CampusName">
                                            <option value=""> --- Select Here --- </option>
                                            @foreach ($camp as $cp)
                                                <option value="{{ $cp->id }}" 
                                                @if(isset($uEdit) && $cp->id == $uEdit->campus_id) selected @endif> {{ $cp->campus_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left CampusName_error"></span>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Role:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text" name="Role" value="{{ (isset($uEdit)) ? $uEdit->role : '' }}" placeholder="Enter Role" class="form-control" autocomplete="off">
                                    </div>    
                                    <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left Username_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" name="btn-submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card card-success card-outline">
                @if(request()->is('users/ulist/*'))
                <div class="card-header">
                    <div class="col-md-12">
                        <ol class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('ulist') }}">User</a></li>
                            <li class="breadcrumb-item">Edit</li>
                        </ol>                            
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Campus Name</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Contact no.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($user as $user)
                                <tr id="tr-{{ $user->uid }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $user->campus_name }}</td>
                                    <td>{{ $user->lname }}</td>
                                    <td>{{ $user->fname }}</td>
                                    <td>{{ $user->mname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->office_abbr }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->contact_no }}</td>
                                    <td>
                                        <a href="{{ route('uEdit', $user->uid) }}" class="btn btn-info btn-xs">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </a>
                                        <button value="{{ $user->uid }}" class="btn btn-danger btn-xs users-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection