@if(Route::currentRouteName() === 'drive-account')
<div class="modal fade" id="newAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAccountModalLabel">New Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{  route('uCreate') }}" method="POST">
                    @csrf
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
                                    <input type="hidden" name="uid" value="">
                                    <input type="text" name="LastName" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control" autocomplete="off">
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
                                    <input type="text" name="FirstName" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control" autocomplete="off">
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
                                    <input type="text" name="MiddleName" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control" autocomplete="off">
                                </div>
                                <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left MiddleName_error"></span>
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
                                    <input type="text" name="Username" placeholder="Enter Username" class="form-control" autocomplete="off">
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
                                    <input type="password" name="Password" value="" placeholder="Enter Password" class="form-control" autocomplete="off">
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
                                            <option value="{{ $cp->id }}">{{ $cp->campus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left CampusName_error"></span>
                           </div>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="exampleInputName">Role:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                    </div>
                                    <select class="form-control select_camp" name="Role">
                                        <option value=""> --- Select Role --- </option>
                                        <option value="Staff" selected>Staff</option>
                                    </select>
                                </div>
                                <span id="error" style="color: #FF0000; font-size: 10pt;" class="form-text text-left Role_error"></span>
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
</div>
@endif