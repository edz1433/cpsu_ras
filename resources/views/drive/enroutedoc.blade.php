@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <div class="row">

                       <div class="col-lg-3 col-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ count($docuCount) }}</h3>
                                    <p>Documents</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ count($userCount) }}</h3>
                                    <p>In Transit</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <a href="{{ route('ulist') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-3">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ count($userCount) }}</h3>
                                    <p>User</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="{{ route('ulist') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
@endsection