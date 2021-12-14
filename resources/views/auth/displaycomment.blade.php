<html>

<body>

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        {{-- <link rel="stylesheet"
            href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
        <!-- iCheck -->
        {{-- <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
        <!-- JQVMap -->
        <!-- Theme style -->
        {{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> --}}
        <link rel="stylesheet" type="text/css"
            href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
            id="bootstrap-css">

    </head>
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

        .view-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            padding-left: 0;
            margin-bottom: 0;
        }

        .thumbnail {
            margin-bottom: 30px;
            padding: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
        }

        .item.list-group-item {
            float: none;
            width: 100%;
            background-color: #fff;
            margin-bottom: 30px;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 1rem;
            border: 0;
        }

        .item.list-group-item .img-event {
            float: left;
            width: 30%;
        }

        .item.list-group-item .list-group-image {
            margin-right: 10px;
        }

        .item.list-group-item .thumbnail {
            margin-bottom: 0px;
            display: inline-block;
        }

        .item.list-group-item .caption {
            float: left;
            width: 70%;
            margin: 0;
        }

        .item.list-group-item:before,
        .item.list-group-item:after {
            display: table;
            content: " ";
        }

        .item.list-group-item:after {
            clear: both;
        }

    </style>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="pull-right">
                    <div class="btn-group">
                        <li class="nav-item d-none d-sm-inline-block">
                            <button class="btn btn-light" style="margin-left: 1030px"><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <b>Sign out</b></a>
                            </button>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div id="products" class="row view-group">
            <div class="item col-xs-4 col-lg-12">
                <div class="thumbnail card">
                    @php
                        $count = DB::table('likes')
                            ->where('blog_id', $query->id)
                            ->count();
                    @endphp

                    @php
                        $countcomment = DB::table('comments')
                            ->where('blog_id', $query->id)
                            ->count();
                    @endphp
                    {{-- <div id="{{ $query->id }}"></div> --}}
                    <div class="img-event">
                        <center>
                            <img src="{{ $query->image }}" class="img-thumbnail" height="800px;" width="800px;"
                                id="imageshow">
                        </center>
                    </div>
                    <div class="caption card-body">
                        <h4 class="group card-title inner list-group-item-heading">
                            {{ $query->title }}</h4>
                        <p class="group inner list-group-item-text">
                            {{ $query->description }}</p>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <button type="button" class="btn btn-light view hvr" id="likeblog"
                                    data-id="{{ $query->id }}">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <b class="m{{ $query->id }}">{{ $count }}</b>
                                </button>
                                <button type="button" class="btn btn-light view hvrc" id="commentblog"
                                    data-id="{{ $query->id }}" data-toggle="modal"
                                    data-target="#exampleModalCenter2">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                    <b id="m{{ $query->id }}">{{ $countcomment }}</b>
                                </button>
                                <button type="button" class="btn btn-light view hvrv" id="multicommentview"
                                    data-id="{{ $query->id }}" data-toggle="modal"
                                    data-target="#exampleModalCenter3">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-xs-12 col-md-20">&nbsp;&nbsp;
                                <a class="btn btn-secondary" href="{{ route('auth.display') }}">Back</a>
                            </div>

                            {{-- Add Comment --}}
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
                            {{-- End Add Comment --}}

                            {{-- View Comment --}}
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
                                            <input type="hidden" class="form-control userid"
                                                value="{{ Auth::user()->id }}">
                                            <input type="hidden" class="form-control viewid" name="viewid">
                                            <div class="alert alert-success d-none" id="msg_div">
                                                <span id="res_message"></span>
                                            </div>
                                            <div class="tbl">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End View Comment --}}

                            {{-- Edit Specific Comment --}}
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
                            {{-- End Edit Specific Comment --}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

    <script>
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
                        $('.m' + response.id).html(response.data);
                    } else {
                        $('.m' + response.id).html(response.data);
                        toastr.error('Dislike..!!');
                    }
                }
            });
        });


        $(document).on("click", '#multicommentview', function() {
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
                    var ids = $('.userid').val();
                    $.each(response.query, function(key, value) {

                        var d = new Date(value.created_at);
                        var h = d.getHours();
                        var m = d.getMinutes();
                        var s = d.getSeconds();
                        var ampm = (h < 12 || h === 24) ? "AM" : "PM";
                        var time = h + ':' + m +
                            ':' + s + ':' + ampm;

                        if (ids == value.user_id) {
                            htm +=
                                "<button class='btn btn-light editspecificuser' data-id='" +
                                value.id +
                                "' id='editcomment' data-toggle='modal' data-target='#editModalCenter'><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-light deletespecificuser' data-id='" +
                                value.id +
                                "'><i class='fa fa-trash'></i></button>";
                        }
                        htm +=
                            "<b>Written By : <span class='" + value.user_id +
                            "'></span></b><div class='form-group'>" +
                            "<input class='form-control' type='text' class='col-sm-12' value=" +
                            value.comment +
                            " disabled><input class='form-control' type='text' class='' value=" +
                            time +
                            " disabled style='border:0px;'>";
                    })
                    $('.tbl').html(htm);
                    $.each(response.user, function(key, value) {
                        $('.' + value.id).html(value.name);
                    });
                }
            });
        });


        $(document).on("click", '.editspecificuser', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.editspecificcomment') }}",
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
                    url: "{{ route('crud.updatespecificcomment') }}",
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


        $(document).on("click", '.deletespecificuser', function() {
            var id = $(this).data('id');
            var element = this;
            if (confirm("Are You Want To Delete This...???")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    type: "POST",
                    url: "{{ route('crud.deletespecificcomment') }}",
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
    </script>
</body>

</html>
