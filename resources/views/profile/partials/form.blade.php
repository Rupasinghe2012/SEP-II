<div class="panel-heading">
    @if( $formType == 'index')
        <a href="/my-profile/{{ $userDetails[0]->id }}/edit"><i class="glyphicon glyphicon-edit pull-right"></i></a>
    @endif
    <h3 class="panel-title">My Profile - {{ $userDetails[0]->name }}</h3>
</div>
<form  class="form-horizontal" id="userStoryForm" method="PUT">
    {{--user details panel--}}
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-2 control-label">User ID :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="userId" value="{{ $userDetails[0]->id }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">E-mail :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="userEmail" value="{{ $userDetails[0]->email }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Full Name :</label>
            <div class="col-sm-10">
        @if( $formType == 'index')
            <input type="text" class="form-control" value="{{ $userDetails[0]->name }}" readonly>
        @else
            <input type="text" name="userName" id="fullName" class="form-control" value="{{ $userDetails[0]->name }}" placeholder="Full Name">
        @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Date Of Birth:</label>
            <div class="col-sm-10">
                @if( $formType == 'index')
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                    <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $userDetails[0]->BOD }}" readonly>
                        </div>
                @else
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                    <input type="text"  id="BOD" name="BOD"  class="form-control"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $userDetails[0]->BOD }}" >
                                </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Address :</label>
            <div class="col-sm-10">
                @if( $formType == 'index')
                    <input type="textarea" class="form-control" value="{{ $userDetails[0]->address }}" placeholder="Entter Your Address" readonly>
                @else
                    <input type="textarea" id="address" name="address" class="form-control" value="{{ $userDetails[0]->address }}" placeholder="Entter Your Address">
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Employment :</label>
            <div class="col-sm-10">
                @if( $formType == 'index')
                    <input type="text" class="form-control" value="{{ $userDetails[0]->job }}"  placeholder="Enter your Job"readonly>
                @else
                    <input type="text" id="job" name="job" placeholder="Enter your Job"  class="form-control" value="{{ $userDetails[0]->job }}" >
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Mobile No :</label>
            <div class="col-sm-10">
                @if( $formType == 'index')
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" id="mobile" name="mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $userDetails[0]->mobile}}" readonly>
                    </div>
                @else
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" id="mobile" name="mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{ $userDetails[0]->mobile}}">
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Post :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $userDetails[0]->type }}" readonly>
            </div>
        </div>
        @if( $formType == 'edit')
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#passwordModal">
                Change Password
            </button>
            <br/><br/>
            <div>
                <a href="/{{ $type }}/my-profile/{{ $userDetails[0]->id }}">
                    <button type="button" class="btn btn-default">Cancel</button>
                </a>
                <button id="profileSubmit" type="button" class="btn btn-primary pull-right">Update</button>
            </div>
        @endif
        <input id="type" type="hidden" value={{ $type }}>
    </div>
    {{--password change modal--}}
    <div id="passwordModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body col-sm-12">
                    <form class="form-horizontal">
                        <div class="form-group">
                    <label class="col-sm-4 control-label">Current Password : </label>
                            <div class="col-sm-8">
                    <input type="password" id="currentPass" name="currentPassword" class="form-control " placeholder="Enter Current Password">
                                </div>
                            </div>
                    <br/>
                        <div class="form-group">
                    <label class="col-sm-4 control-label">New Password : </label>
                            <div class="col-sm-8">
                    <input type="password" id="newPass" name="newPassword" class="form-control" placeholder="Enter New Password">
                                </div>
                            </div>
                    <br/>
                        <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm New Password : </label>
                            <div class="col-sm-8">
                    <input type="password" id="confirmPass" name="confirmPassword" class="form-control" placeholder="Re-Type the New Password">
                                </div>
                    <label style="display: none" class="error" id="error">New password do not match</label>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" id="passwordConfirm" class="btn btn-primary pull-right">Confirm</button>
</form>
                </div>
            </div>
        </div>
    </div>
</form>
