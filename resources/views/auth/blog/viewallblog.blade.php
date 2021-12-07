@extends('auth.layout.master')

@section('content');
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Blog Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content" style="border: none;">
            <div class="container-fluid" style="border: none;">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @foreach ($query as $querys)
                        <div class="card" style="width:300px;margin-right: 40px;background-color: transparent">
                            <div class="card-body" id="show">

                                @php
                                    $count = DB::table('likes')
                                        ->where('blog_id', $querys->id)
                                        ->count();
                                @endphp

                                @php
                                    $countcomment = DB::table('comments')
                                        ->where('blog_id', $querys->id)
                                        ->count();
                                @endphp


                                <div id="{{ $querys->id }}">
                                    @php
                                        $userInfo = DB::table('users')
                                            ->where('id', $querys->user_id)
                                            ->first();
                                    @endphp

                                    <center><b style="color:black">{{ $userInfo->name }}</b></center>

                                    <img src="{{ $querys->image }}" class="img-thumbnail" id="imageshow" height="150px">
                                    <h3>{{ $querys->title }}</h3>
                                    <b>{{ $querys->description }}</b>
                                    <div>

                                        <button type="button" style="background-color: transparent; border:none;"
                                            class="btn btn-light view hvr" id="likeblog" data-id="{{ $querys->id }}">
                                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                            <b class="{{ $querys->id }}">{{ $count }}</b>
                                        </button>
                                        <button type="button" style="background-color: transparent; border:none;"
                                            class="btn btn-light view hvrc" id="commentblog" data-id="{{ $querys->id }}"
                                            data-toggle="modal" data-target="#exampleModalCenter2">
                                            <i class="fa fa-comment" aria-hidden="true"></i>
                                            <b id="m{{ $querys->id }}">{{ $countcomment }}</b>
                                        </button>
                                        <button type="button" style="background-color: transparent; border:none;"
                                            class="btn btn-light view" id="commentview" data-id="{{ $querys->id }}"
                                            data-toggle="modal" data-target="#exampleModalCenter3">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Add Comment --}}
                    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalCenterTitle"><b>Comment
                                            Box</b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="commentform">
                                        @csrf
                                        <input type="hidden" class="form-control" id="blogid" name="blogid">
                                        <div class="alert alert-success d-none" id="msg_div">
                                            <span id="res_message"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Blog
                                                Comment :</label>
                                            <input type="text" class="form-control adcoment" id="comments" name="comments">
                                            @error('comments')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" value="submit">Done</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Add Comment --}}

                    {{-- View Comment --}}
                    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalCenterTitle"><b>View
                                            Comment</b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="commentform">
                                        @csrf
                                        <input type="hidden" class="form-control" id="viewid" name="viewid">
                                        <div class="alert alert-success d-none" id="msg_div">
                                            <span id="res_message"></span>
                                        </div>
                                        <div class="tbl">
                                            {{-- view comment data here show --}}
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End View Comment --}}
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script>
        $(document).on("click", '.hvrc', function() {
            $('.adcoment').val('');
        });


        $(document).on("click", '#commentblog', function() {
            var id = $(this).attr('data-id');
            $('#blogid').val(id);
        });


        $("#commentform").validate({
            rules: {
                'comments': {
                    required: true
                },
            },
            messages: {
                'comments': {
                    required: "Please Enter Comment..!!!"
                },
            },
            submitHandler: function(form) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "{{ route('crud.addcomment') }}",
                    data: new FormData(form),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(response) {
                        if (response.success == 1) {
                            $('#m' + response.id).html(response.data);
                            $("#exampleModalCenter2").modal('hide');
                            location.reload();
                            toastr.success('Comment Add Successfully');
                        }
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
        $("#exampleModalCenter2").on('hide.bs.modal', function() {
            $(".error").empty();
        });


        $(document).on("click", '#commentview', function() {
            var id = $(this).attr('data-id');
            var htm = '';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.multiviewcomment') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);
                    $.each(response, function(key, value) {
                        htm +=
                            "<input type='text' class='col-sm-12' value=" +
                            value.user_id +
                            " disabled style='border: 0px'><div class='form-group'><input type='text' class='col-sm-12' value=" +
                            value.comment +
                            " disabled style='border: 0px'>&nbsp;";
                    })
                    $('.tbl').html(htm);
                }
            });
        });


        $(document).on("click", '#likeblog', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.multilike') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success == 1) {
                        $('.' + response.id).html(response.data);
                    } else {
                        toastr.error('You already give a like..!!');
                    }
                }
            });
        });
    </script>
@endpush
