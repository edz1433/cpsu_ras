
@if(Route::currentRouteName() === 'drive' || Route::currentRouteName() === 'sub-folder')
<div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFolderModalLabel">Create Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" @if(Route::currentRouteName() === 'drive')  action="{{ route('create-folder') }}"  @else  action="{{ route('create-subfolder', $folder->id) }}" @endif>
                    @csrf
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-folder"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="folderName" name="folderName" placeholder="Folder Name" autocomplete="off" required>
                        </div>
                        <span class="badge badge-secondary mb-1 mt-2">authorize users</span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-building"></i>
                                </span>
                            </div>
                            <select class="form-control select2" style="width: 90%;" name="user_access[]" multiple required>
                                <option value="All" selected>All</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFolderModalLabel">Rename Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('update-folder') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="fid" id="fid">
                        <input type="text" class="form-control" id="folder-naame" name="folderName" placeholder="Folder Name" autocomplete="off" required>
                    </div>
                    <span class="badge badge-secondary mb-1 mt-2">give access</span>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-building"></i>
                            </span>
                        </div>
                        <select class="form-control select2" style="width: 90%;" name="user_access[]" multiple required>
                            <option value="All" selected>All</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFileModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="POST" action="@if(Route::currentRouteName() === 'sub-folder') {{ route("document-store", $id) }} @endif" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Choose File:</label>
                        <input type="hidden" class="form-control-file" name="process" value="modalupload">
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        
                    <button type="button" onclick="validateAndSubmit()" class="btn btn-success float-right"><i class="fas fa fa-upload"></i> Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editFilerModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFolderModalLabel">Rename File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('document-update') }}">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="file_id" id="file-id">
                        <input type="text" class="form-control" id="file-name" name="file_name" placeholder="File Name" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
