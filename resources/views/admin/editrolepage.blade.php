@extends('admin.layout.master')

@section('content');
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Role</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            {{-- <li class="breadcrumb-item active">DataTables</li> --}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form method="POST" action="{{ route('admin.updaterole') }}" id="register">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $role->id }}">
                                <div class="alert alert-success d-none" id="msg_div">
                                    <span id="res_message"></span>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Role :</label>
                                    <input type="text" class="form-control" id="role" name="role"
                                        value="{{ $role->name }}">
                                    @error('role')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Permission :</label>
                                    <select class="form-control js-example-basic-multiple" multiple name="permission[]"
                                        required>
                                        <option value="">select permission </option>
                                        @foreach ($permission as $permissions)
                                            <option value="{{ $permissions->id }}" @if (in_array($permissions->id, $rolePermissions)) selected @endif)>
                                                {{ $permissions->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('permission')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" id="addbutton" value="Submit">
                                    <div id="msgdisplay"></div>
                                </div>
                            </form>
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

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

       /* $("#register").validate({
            rules: {
                'role': {
                    required: true
                },
                'permission[]': {
                    required: true
                },
            },
            messages: {
                'role': {
                    required: "Please Enter Role...!!!"
                },
                'permission[]': {
                    required: "Please Select Permission...!!!"
                },
            },
            submitHandler: function(form) {

            }
        });*/

    </script>
@endpush
