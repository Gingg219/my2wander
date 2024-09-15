@extends('admin.layout.master')
@section('content')
<div id="change-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title" id="primary-header-modalLabel">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="pl-3 pr-3" method="POST" id="form-change-password">

                    <div class="form-group">
                        <label for="username">Password</label>
                        <input class="form-control" type="password" id="username" required="" name="current_password" placeholder="Enter your password">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="current_password"></div>
                    </div>

                    <div class="form-group">
                        <label for="emailaddress">New password</label>
                        <input class="form-control" type="password" id="emailaddress" required="" name="new_password" placeholder="Enter your password">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="new_password"></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Confirm new password</label>
                        <input class="form-control" type="password" required="" id="password" name="new_password_confirmation" placeholder="Enter your password">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="new_password_confirmation"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" id="close-modal-change-password">Close</button>
                <button type="button" class="btn btn-primary" id="btn-change-password">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="tab-content">
    <div class="tab-pane active" id="settings">
        <form id="formChangeInfo" method="POST">
            @csrf
            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="Enter first name">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="name"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="useremail">Phone Number</label>
                        <input type="number" class="form-control" value="{{ $user->mobile }}" name="mobile" placeholder="Enter Number Phone">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="mobile"></div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="useremail">Email Address</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="Enter email">
                        <div class="invalid-feedback print-error-msg" style="display:none" id="email"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" disabled value="kocogidaumaxem" id="userpassword" placeholder="Enter password">
                        <span class="form-text text-muted"><small>If you want to change password please click <a data-toggle="modal" data-target="#change-password-modal" href="#">here.</a></small></span>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="text-right">
                <button type="submit" class="btn btn-success mt-2" id="btnSubmitFormChangeInfo"><i class="mdi mdi-content-save"></i> Save</button>
            </div>
        </form>
    </div>
    <!-- end settings content-->
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#btnSubmitFormChangeInfo').on('click', function (e) {
                e.preventDefault();
                formData = $('#formChangeInfo').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.users.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function (data) {
                        if(data && data['status'] == {{ config('constants.CODE_STATUS.SUCCESS') }}){
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "success");
                            setTimeout(location.reload.bind(location), 2000);
                        }else {
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "fail");
                        }
                    },
                    error: function(data) {
                        printErrorMsg(data.responseJSON.errors);
                    }
                });
            });

            $('#btn-change-password').on('click', function (e) {
                e.preventDefault();
                formData = $('#form-change-password').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.users.change_password') }}",
                    data: formData,
                    dataType: "json",
                    success: function (data) {
                        if(data && data['status'] == {{ config('constants.CODE_STATUS.SUCCESS') }}){
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "success");
                            $("#close-modal-change-password").click();
                        }else {
                            $.NotificationApp.send(data.titile, data.message, "top-right", "#9EC600", "fail");
                        }
                    },
                    error: function(data) {
                        printErrorMsg(data.responseJSON.errors);
                    }
                });
            });
        });
    </script>
@endpush
