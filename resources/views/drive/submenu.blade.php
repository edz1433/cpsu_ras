<div class="btn-group w-100">
    <button type="button" class="btn btn-secondary btn-block mb-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus"></i> New
    </button>
    <div class="dropdown-menu w-100">
        @if(Route::currentRouteName() == 'drive' || Route::currentRouteName() == 'sub-folder') 
            @if(auth()->user()->role != "Staff") 
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#createFolderModal">Create Folder</a>
            @endif
            @if(Route::currentRouteName() == 'sub-folder') 
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#uploadFileModal">Upload File</a>
            @endif          
        @else
        @if(auth()->user()->role != "Staff" && request()->is('account*') ? 'active' : '') 
            <a class="dropdown-item" href="{{ route('create-account') }}">New Account</a>
        @endif
        @endif 
    </div>
</div>
<div class="card card-success card-outline p-1">
    <h5 class="card-title" style="font-size: 17pt"></h5>
    <ul class="nav nav-pills nav-sidebar nav-compact flex-column">
        <li class="nav-item mb-1">
            <a href="{{ route('drive') }}" class="nav-link2 {{ request()->is('drive*') ? 'active' : '' }}" id="allButton">
                <i class="fas fa-hdd"></i>
                <span class="ml-2">My Drive</span>
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('logs') }}" class="nav-link2 {{ request()->is('logs*') ? 'active' : '' }}" id="ppeButton">
                <i class="fas fa-file-alt"></i>
                <span class="ml-2">Logs</span>
            </a>
        </li>
    </ul>                     
</div>

<div class="card p-1">
    <h5 class="card-title" style="font-size: 17pt"></h5>
    <ul class="nav nav-pills nav-sidebar nav-compact flex-column">
        <li class="nav-item">
            <a href="{{ route('drive-account') }}" class="nav-link2 {{ request()->is('account*') ? 'active' : '' }}" id="allButton">
                <i class="fas fa-users"></i>
                <span class="ml-2">Account</span>
            </a>
        </li>
    </ul>                     
</div>