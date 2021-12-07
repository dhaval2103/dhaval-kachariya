@extends('admin.layout.master')

@section('content');
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="card"> --}}
                    {{-- <div class="card-header"> --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">Education</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form method="POST" id="register" action="">
                                        @csrf
                                        <input type="hidden" class="form-control" id="userid" name="userid">
                                        <div class="alert alert-success d-none" id="msg_div">
                                            <span id="res_message"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="education_name" class="col-form-label">Education :</label>
                                            <input type="text" class="form-control" id="education" name="education">
                                            @error('education')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="start_year" class="col-form-label">Start Year :</label><br>
                                            <input type="text" class="form-control" name="startyear" id="startyear">
                                            @error('startyear')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="end_year" class="col-form-label">End Year :</label><br>
                                            <input type="text" class="form-control" name="endyear" id="endyear">
                                            @error('endyear')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Role :</label><br>
                                            <select style="width: 465px" class="form-control js-example-basic-multiple" multiple name="Role[]"
                                                required>
                                                <option value="" disabled>Assign Role</option>
                                                @foreach ($permission as $permissions)
                                                    <option value="{{ $permissions->id }}">
                                                        {{ $permissions->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div> --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success addbutton">Submit</button>
                                            {{-- <input type="submit" name="submit" value="submit"> --}}
                                            <div id="msgdisplay"></div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                    {{-- view data --}}
                    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">View Education</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="a">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Education</th>
                                                <th>Start Year</th>
                                                <th>End Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbl">
                                            {{-- <td>{{ $data->education }}</td>
                                <td>{{ $data->syear }}</td>
                                <td>{{ $data->eyear }}</td> --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    {{-- <button type="submit" class="btn btn-success addbutton">Submit</button> --}}
                                    <div id="msgdisplay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end view data --}}

                {{-- user edit modal --}}
                <div class="modal fade" id="usereditmodal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Edit User-Detail</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="userform" method="POST">
                                    <input type="hidden" class="form-control userofid" name="id">
                                    <div class="alert alert-success d-none" id="msg_div">
                                        <span id="res_message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_name" class="col-form-label">User Name :</label>
                                        <input type="text" class="form-control uname" name="uname">
                                        @error('uname')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email :</label><br>
                                        <input type="email" class="form-control email" name="email">
                                        @error('email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Role :</label><br>
                                        <select style="width: 465px" class="form-control js-example-basic-multiple" multiple
                                            name="role[]" required>
                                            <option value="" disabled>Assign Role</option>
                                            @foreach ($permission as $permissions)
                                                <option value="{{ $permissions->id }}" @if ($permissions->id) selected @endif>
                                                    {{ $permissions->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <div id="msgdisplay"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end useredit data --}}

                {{-- edit data --}}
                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">View Education</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="updateform" method="POST">
                                    <input type="hidden" class="form-control educationid" id="eduid" name="eduid">
                                    <input type="hidden" class="form-control educationid" id="user_id" name="user_id">
                                    <div class="alert alert-success d-none" id="msg_div">
                                        <span id="res_message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="education_name" class="col-form-label">Education :</label>
                                        <input type="text" class="form-control education" name="education">
                                        @error('education')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="start_year" class="col-form-label">Start Year :</label><br>
                                        <input type="text" class="form-control startyr" name="startyear">
                                        @error('startyear')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="end_year" class="col-form-label">End Year :</label><br>
                                        <input type="text" class="form-control endyr" name="endyear">
                                        @error('endyear')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <div id="msgdisplay"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header" style="width:100%;">
                    <button style="float-right" class="btn btn-warning" id="bulk_delete" name="bulk_delete"><b>Selected
                            Record Delete</b></button>
                </div>
            </div>
            {{-- end edit data --}}
            <div class="card-body">
                {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) }}
            </div>
    </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
@endsection


@push('script')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        /*  Add Date  */

        $(document).ready(function() {
            var currentDate = new Date();
            $('#startyear').datepicker({
                showButtonPanel: true,
                timepicker: false,
                dateFormat: "yy-mm-dd",
                autoclose: true,
                endDate: "currentDate",
                maxDate: currentDate
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            $('#startyear').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });


        $(document).ready(function() {
            var currentDate = new Date();
            $('#endyear').datepicker({
                showButtonPanel: true,
                timepicker: false,
                dateFormat: "yy-mm-dd",
                autoclose: true,
                endDate: "currentDate",
                maxDate: currentDate
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            $('#endyear').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });

        /*  End Add Date  */


        /*  Edit Date  */

        $(document).ready(function() {
            var currentDate = new Date();
            $('.startyr').datepicker({
                showButtonPanel: true,
                timepicker: false,
                dateFormat: "yy-mm-dd",
                autoclose: true,
                endDate: "currentDate",
                maxDate: currentDate
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            $('.startyr').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });

        $(document).ready(function() {
            var currentDate = new Date();
            $('.endyr').datepicker({
                showButtonPanel: true,
                timepicker: false,
                dateFormat: "yy-mm-dd",
                autoclose: true,
                endDate: "currentDate",
                maxDate: currentDate
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            $('.endyr').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });

        /* End Edit Date  */


        $(document).on("click", '.ids', function() {

            $("#register").trigger('reset');
            $('label.error').remove();

        });

        $(document).on('click', '.ids', function() {

            var a = $(this).data('id');
            $('#userid').val(a);

        })
        $("#register").validate({
            rules: {
                'education': {
                    required: true
                },
                'startyear': {
                    required: true
                },
                'endyear': {
                    required: true
                },
                'role': {
                    required: true
                },
            },
            messages: {
                'education': {
                    required: "Please Enter Education...!!!"
                },
                'startyear': {
                    required: "Please Select Start Of Education Year...!!!"
                },
                'endyear': {
                    required: "Please Select End Of Education Year...!!!"
                },
                'role': {
                    required: "Please Select Role...!!!"
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.education') }}",
                    contentType: false,
                    processData: false,
                    data: new FormData(form),
                    success: function(data) {
                        if (data == 1) {
                            $('#userdatatable-table').DataTable().ajax.reload();
                            $('#exampleModal').modal('hide');
                            toastr.success('Education Add Successfully');
                        }
                    }
                });
            }
        });


        $(document).on("click", '#deletedata', function() {
            var id = $(this).data('id');
            if (confirm("Are You Sure You Want To Delete This..??")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.deletedata') }}",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {

                        $('#userdatatable-table').DataTable().ajax.reload();
                        toastr.error('Delete Successfully');
                    }
                });
            } else {
                return false;
            }
        });


        $(document).on("click", '.dlt', function() {
            var id = $(this).data('id');
            var element = this;
            if (confirm("Are You Want To Delete This...???")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.deleteeducation') }}",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $(element).closest('tr').fadeOut();
                        toastr.error('Delete Successfully');
                    }
                });
            } else {
                return false;
            }
        });


        $(document).on("click", '#bulk_delete', function() {

            var id_arr = [];
            $(".multicheck:checked").each(function() {
                id_arr.push($(this).data('id'));
            });
            if (id_arr.length > 0) {

                var confirmdelete = confirm("Do you really want to Delete records?");
                if (confirmdelete == true) {

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        type: 'POST',
                        url: "{{ route('admin.multiplechecked') }}",
                        dataType: "json",
                        data: {
                            'id': id_arr
                        },
                        success: function(data) {
                            $('#userdatatable-table').DataTable().ajax.reload();
                            toastr.error('Selected Record Delete Successfully');
                        }
                    });
                }
            }
        });


        $(document).on("click", '.Allselect', function() {
            if ($(".Allselect").length == $(".Allselect:checked").length) {
                $(".multicheck").prop("checked", true);
            } else {
                $(".multicheck").prop("checked", false);
            }

        });


        $(document).on("click", '.view', function() {
            var id = $(this).data('id');

            var htm = '';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                url: "{{ route('admin.vieweducation') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {

                    console.log(response);
                    $.each(response, function(key, value) {
                        htm += "<tr class='demo'><td>" + value.education + "</td><td>" + value
                            .syear + "</td><td>" + value.eyear +
                            "</td><td><button type='button' class='btn btn-danger dlt' data-id='" +
                            value.id +
                            "'><i class='fas fa-trash'></i></button>&nbsp;&nbsp;<button type='button' class='btn btn-success edt' data-user-id='" +
                            value.uid + "' data-id='" + value.id +
                            "'  data-toggle='modal' data-target='#editmodal' data-whatever='@mdo'><i class='fa fa-edit'></i></button></td></tr>";
                    })
                    $('.tbl').html(htm);

                }
            });
        });


        $(document).on("click", '.edt', function() {
            var id = $(this).data('id');
            var user_id = $(this).data('user-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                url: "{{ route('admin.editeducation') }}",
                dataType: "json",
                data: {
                    'id': id
                },
                success: function(response) {
                    console.log(response);
                    $('#exampleModalLabel').html('Education');
                    $('.educationid').val(response.id);
                    $('.education').val(response.education);
                    $('.startyr').val(response.syear);
                    $('.endyr').val(response.eyear);
                    $('#eduid').val(response.id);
                    $('#user_id').val(response.uid);
                }
            });
        });


        $(document).on("click", '.edituser', function() {
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                url: "{{ route('admin.edituserdata') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {

                    // $('#exampleModalLabel').html('Education');
                    $('.userofid').val(response.id);
                    $('.uname').val(response.name);
                    $('.email').val(response.email);
                    $('.role').val(response.name);
                }

            });
        });


        $("#updateform").validate({
            rules: {
                'education': {
                    required: true
                },
                'startyear': {
                    required: true
                },
                'endyear': {
                    required: true
                },
            },
            messages: {
                'education': {
                    required: "Please Enter Education...!!!"
                },
                'startyear': {
                    required: "Please Select Start Of Education Year...!!!"
                },
                'endyear': {
                    required: "Please Select End Of Education Year...!!!"
                },
            },
            submitHandler: function(form) {
                var htm = '';
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.updateeducation') }}",
                    contentType: false,
                    processData: false,
                    data: new FormData(form),
                    success: function(data) {
                        console.log(data);
                        $('#editmodal').modal('hide');
                        $.each(data, function(key, value) {
                            htm += "<tr class='demo'><td>" + value.education + "</td><td>" +
                                value.syear + "</td><td>" + value.eyear +
                                "</td><td><button type='button' class='btn btn-danger dlt' data-id='" +
                                value.id +
                                "'><i class='fas fa-trash'></i></button>&nbsp;&nbsp;<button type='button' class='btn btn-success edt' data-id='" +
                                value.id +
                                "' data-toggle='modal' data-target='#editmodal' data-whatever='@mdo'><i class='fa fa-edit'></i></button></td></tr>";
                        })
                        $('.tbl').html(htm);
                        toastr.success('Update Successfully');
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('[name=' + field_name + ']').after(
                                '<span class="text-strong" style="color:red">' +
                                errors + '</span>')
                        })
                    }
                });
            }
        });
        $("#editmodal").on('hide.bs.modal', function() {
            $(".error").empty();
        });



        $("#userform").validate({
            rules: {
                'uname': {
                    required: true
                },
                'email': {
                    required: true
                },
            },
            messages: {
                'uname': {
                    required: "Please Enter User Name...!!!"
                },
                'email': {
                    required: "Please Enter Your EmailID...!!!"
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.updateuserdata') }}",
                    contentType: false,
                    processData: false,
                    data: new FormData(form),
                    success: function(data) {
                        if (data == 1) {
                            $('#userdatatable-table').DataTable().ajax.reload();
                            $('#usereditmodal').modal('hide');
                            toastr.success('Update Successfully');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        $.each(response.responseJSON.errors, function(field_name, errors) {
                            $('[name=' + field_name + ']').after(
                                '<span class="text-strong" style="color:red">' +
                                errors + '</span>')
                        })
                    }
                });
            }
        });
        $("#usereditmodal").on('hide.bs.modal', function() {
            $(".error").empty();
        });
    </script>
@endpush
