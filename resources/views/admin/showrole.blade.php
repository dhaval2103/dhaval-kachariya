@extends('admin.layout.master')

@section('content');
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Role</h1>
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
                    {{-- view data --}}
                    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">Permission</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="a">
                                    <div class="tbl">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <div id="msgdisplay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end view data --}}
                </div>


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
        $(document).on("click", '#view', function() {
            var id = $(this).data('id');
            var htm = '';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "POST",
                url: "{{ route('admin.viewpermission') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        htm +=
                            "<input class='form-control' type='text' class='col-sm-12' value=" +
                            value.name +
                            " disabled>";
                    })
                    $('.tbl').html(htm);
                }
            });
        });


        
        $(document).on("click", '#delete', function() {
            var id = $(this).data('id');
            if (confirm("Are You Sure You Want To Delete This..??")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('admin.deleterole') }}",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {

                        $('#roledatatable-table').DataTable().ajax.reload();
                        toastr.error('Delete Successfully');
                    }
                });
            } else {
                return false;
            }
        });
    </script>
@endpush
