@php
    $current_route=request()->route()->getName();
@endphp

<div class="row pt-2 bg-gray rounded">
    <div class="col-sm-10">
        <div>
            
            @if(auth()->user()->role != "Staff") 
            <a href="{{ route('dashboard') }}" class="btn btn-app {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="fas fa-dashboard"></i> Dashboard
            </a>
            @endif

            <a href="{{ route('drive') }}" class="btn btn-app {{ request()->is('drive*') || request()->is('account*') || request()->is('logs*')? 'active' : '' }}">
                <i class="fas fa-folder"></i> Drive
            </a>

            @if(auth()->user()->role == "Administrator") 
                <a href="{{ route('ulist') }}" class="btn btn-app {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="fas fa-user-gear"></i> Users
                </a>
            @endif
            
            <a href="" class="btn btn-app {{ request()->is('settings*') ? 'active' : '' }}">
                <i class="fas fa-gear"></i> Settings
            </a>
        </div>
    </div>
    
    <div class="col-sm-2" style="text-align: right;" >
        <div>
            <a href="{{ route('logout') }}" class="btn btn-app pull-right">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </a>
        </div>
    </div>
</div>