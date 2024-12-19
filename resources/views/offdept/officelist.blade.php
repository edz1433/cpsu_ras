@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-3">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> {{ (request()->is('office')) ? "Add" :  "Edit" }}
                    </h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ (request()->is('office/*')) ? route('officeUpdate') : route('officeCreate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Office Name:</label>
                                    <input type="hidden" name="oid" value="{{ (request()->is('office/*')) ? $officeedit->id : '' }}" autocomplete="off">
                                    <input type="text" name="OfficeName" class="form-control" value="{{ (request()->is('office/*')) ? $officeedit->office_name : '' }}" autocomplete="off">  
                                </div>
                            </div>
                        </div>
                   

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="exampleInputName">Office Abbreviation:</label>
                                    <input type="text" name="OfficeAbbreviation" value="{{ (request()->is('office/*')) ? $officeedit->office_abbr : '' }}" class="form-control" autocomplete="off" >  
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="reset" class="btn btn-danger">
                                        Clear
                                    </button>
                                    <button type="submit" name="btn-submit" class="btn btn-primary">
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Office</th>
                                    <th>Abbreviation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($office as $office)
                                   
                                    <tr id="tr-{{ $office->id}}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $office->office_name }}</td>
                                        <td>{{ $office->office_abbr }}</td>
                                        <td>
                                            <a href="{{ route('officeEdit', $office->id) }}" class="btn btn-info btn-xs">
                                                <i class="fas fa-exclamation-circle"></i>
                                            </a>
                                            <button value="{{ $office->id }}" class="btn btn-danger btn-xs office-delete">
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