@extends('auth.layout.master')

@section('content');
    <style>
        .hvr:hover {
            padding: 10px;
            transition: 0.5s;
            border: 2px solid black
        }

        .hvrc:hover {
            padding: 10px;
            transition: 0.5s;
            border: 2px solid black
        }

        .hvrv:hover {
            padding: 10px;
            transition: 0.5s;
            border: 2px solid black
        }

    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Your Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @foreach ($query as $querys)
                    <div class="card" style="width:330px;">
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
                                <img src="{{ $querys->image }}" class="card-img-top" id="imageshow" alt="...">
                                <h3>{{ $querys->title }}</h3>
                                <b>{{ $querys->description }}</b>
                                <div>
                                    <button type="button" class="btn btn-primary" id="editblog"
                                        data-id="{{ $querys->id }}" data-toggle="modal" data-target="#exampleModalCenter">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" id="deleteblog"
                                        data-id="{{ $querys->id }}">
                                        Delete
                                    </button>
                                    <button type="button" class="btn btn-light view hvr" id="likeblog"
                                        data-id="{{ $querys->id }}">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        <b class="{{ $querys->id }}">{{ $count }}</b>
                                    </button>
                                    <button type="button" class="btn btn-light view hvrc" id="commentblog"
                                        data-id="{{ $querys->id }}" data-toggle="modal"
                                        data-target="#exampleModalCenter2">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                        <b id="m{{ $querys->id }}">{{ $countcomment }}</b>
                                    </button>
                                    <button type="button" class="btn btn-light view hvrv" id="commentview"
                                        data-id="{{ $querys->id }}" data-toggle="modal"
                                        data-target="#exampleModalCenter3">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div>&nbsp;</div>
                            </div>
                        </div>
                    </div>

                @endforeach

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- @if ($query->count()) --}}
                            {{-- @endif --}}
                            <!--Edit Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form enctype="multipart/form-data" id="formupdate">
                                                @csrf
                                                <input type="hidden" class="form-control" id="formid" name="formid">
                                                <div class="alert alert-success d-none" id="msg_div">
                                                    <span id="res_message"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Blog
                                                        Title :</label>
                                                    <input type="text" class="form-control" id="title" name="title">
                                                    @error('title')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Blog
                                                        Description :</label>
                                                    <textarea class="form-control" id="description"
                                                        name="description"></textarea>
                                                    @error('description')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="image" class="col-form-label">Blog Image
                                                        :</label><br>
                                                    <input type="file" name="image" id="image">
                                                    @error('image')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <img src="" id="imageshows" alt="" height="100px">
                                                </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>


                            <!--Add Comment Modal -->
                            <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalCenterTitle"><b>Comment
                                                    Box</b></h3>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                                    <input type="text" class="form-control adcoment" id="comments"
                                                        name="comments">
                                                    @error('comments')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" value="submit">Done</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- View Comment Model --}}
                            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalCenterTitle"><b>View
                                                    Comment</b></h3>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
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
                                                {{-- <button type="button" class="btn btn-secondary" id="commentblog"
                                                    data-id="{{ $querys->id }}" data-toggle="modal"
                                                    data-target="#exampleModalCenter2">
                                                    Add More Comment
                                                </button> --}}
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- Edit Comment --}}
                            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="editModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="editModalCenterTitle"><b>Comment
                                                    Box</b></h3>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editcommentform">
                                                @csrf
                                                <input type="hidden" class="form-control" id="commenteditid"
                                                    name="commenteditid">
                                                <div class="alert alert-success d-none" id="msg_div">
                                                    <span id="res_message"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Update
                                                        Comment :</label>
                                                    <input type="text" class="form-control edtcoment" id="editcomments"
                                                        name="editcomments">
                                                    @error('editcomments')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" value="submit">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            {{-- </div>
                            </div> --}}
                        </div>
                    </div>
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

        /* EDIT BLOG */
        $(document).on("click", '#editblog', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.blogedit') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#exampleModalCenterTitle').html('blog');
                    $('#title').val(response.title);
                    $('#formid').val(response.id);
                    $('#description').val(response.description);
                    $('#imageshows').attr('src', response.image);
                }
            });
        });


        /* DELETE BLOG */
        $(document).on("click", '#deleteblog', function() {
            var id = $(this).data('id');
            var element = this;
            if (confirm("Are You Sure Want To Delete This...?")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "{{ route('crud.blogdelete') }}",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {

                        $('#' + id).html('');
                        toastr.error('category Delete Successfully');
                    }
                });
            } else {
                return false;
            }

        });


        /* UPDATE BLOG */
        $("#formupdate").validate({
            rules: {
                'title': {
                    required: true
                },
                'description': {
                    required: true
                },
                // 'image':{required:true},
            },
            messages: {
                'title': {
                    required: "Please Enter Title..!!!"
                },
                'description': {
                    required: "Please Enter Description..!!!"
                },
                // 'image':{required:"Please Choose Image..!!!"},
            },
            submitHandler: function(form) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "{{ route('crud.blogupdate') }}",
                    data: new FormData(form),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data) {
                        if (data == 1) {
                            //  $('#exampleModalCenter').modal('hide');
                            //  $("#show").load(location.href + " #show");
                            //  $('#show' + id).html('');
                            location.reload();
                            toastr.success('Category Update Successfully');
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
        $("#exampleModalCenter").on('hide.bs.modal', function() {
            $(".error").empty();
        });


        /* LIKE BLOG */
        $(document).on("click", '#likeblog', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.bloglike') }}",
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


        /* ADD COMMENT BLOG */
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


        $(document).on("click", '#commentblog', function() {
            var id = $(this).attr('data-id');
            $('#blogid').val(id);
        });


        /* VIEW COMMENT */
        $(document).on("click", '#commentview', function() {
            var id = $(this).attr('data-id');
            var htm = '';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.viewcomment') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    //$('#exampleModalScrollableTitle').html('Comment');
                    //$('#viewcomment').val(response.comment);
                    //$('#viewid').val(response.id);
                    console.log(response);
                    $.each(response, function(key, value) {
                        htm +=
                            "<div class='form-group'><input type='text' class='col-sm-9' value=" +
                            value.comment +
                            " disabled style='border: 0px'>&nbsp;&nbsp;&nbsp;<button type='button' class='btn btn-light view dlt' data-id='" +
                            value.id +
                            "' id='deletecomment'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;<button type='button' class='btn btn-light view edt' data-id='" +
                            value.id +
                            "' id='editcomment' data-toggle='modal' data-target='#editModalCenter'><i class='fa fa-edit'></i></button></div>";
                    })
                    $('.tbl').html(htm);
                }
            });
        });


        /* DELETE COMMENT */
        $(document).on("click", '#deletecomment', function() {
            var id = $(this).data('id');
            var element = this;
            if (confirm("Are You Want To Delete This...???")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('crud.dltcomment') }}",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        //$(element).closest('.cmt').fadeOut();
                        $("#exampleModalCenter3").modal('hide');
                        location.reload();
                        toastr.error('Delete Successfully');
                    }
                });
            } else {
                return false;
            }
        });


        /* EDIT COMMENT */
        $(document).on("click", '#editcomment', function() {
            var id = $(this).attr('data-id');
            //   console.log(id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.commentedit') }}",
                dataType: "json",
                data: {
                    id: id
                },
                success: function(response) {
                    $('#editcomments').val(response.comment);
                    $('#commenteditid').val(response.id);
                }
            });
        });


        /* UPDATE COMMENT */
        $("#editcommentform").validate({
            rules: {
                'editcomments': {
                    required: true
                },
            },
            messages: {
                'editcomments': {
                    required: "Please Enter Comment..!!!"
                },
            },
            submitHandler: function(form) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "post",
                    url: "{{ route('crud.commentupdate') }}",
                    data: new FormData(form),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data) {
                        if (data == 1) {
                           // $('' + response.id).html(response.data);
                           // location.reload();
                            $("#editModalCenter").modal('hide');
                            $("#exampleModalCenter3").modal('hide');
                            toastr.success('Comment Update Successfully');

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
        $("#editModalCenter").on('hide.bs.modal', function() {
            $(".error").empty();
        });
    </script>

@endpush
