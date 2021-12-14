  <html>

  <body>

      <head>
          <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
              id="bootstrap-css">
          <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css"
              integrity="sha512-f8gN/IhfI+0E9Fc/LKtjVq4ywfhYAVeMGKsECzDUHcFJ5teVwvKTqizm+5a84FINhfrgdvjX8hEJbem2io1iTA=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />
      </head>
      <style>
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
      {{-- @php
date_default_timezone_set("Asia/Kolkata");
@endphp --}}
      <div class="container">
          <div class="row">
              <div class="col-lg-12 my-3">
                  <div class="pull-right">
                      <div class="btn-group">
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

                      @php
                          $userInfo = DB::table('users')
                              ->where('id', $query->user_id)
                              ->first();
                      @endphp

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
                                  <button type="button" style="background-color: transparent; border:none;"
                                      class="btn btn-light view hvr" id="likeblog" data-id="{{ $query->id }}">
                                      <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                      <b class="{{ $query->id }}">{{ $count }}</b>
                                  </button>
                                  <button type="button" style="background-color: transparent; border:none;"
                                      class="btn btn-light view hvrc" id="commentblog" data-id="{{ $query->id }}">
                                      <i class="fa fa-comment" aria-hidden="true"></i>
                                      <b id="m{{ $query->id }}">{{ $countcomment }}</b>
                                  </button><br>
                                  @foreach ($a as $ab)
                                      @php
                                          $userInfo = DB::table('users')
                                              ->where('id', $ab->user_id)
                                              ->first();
                                      @endphp
                                      @php
                                          $data = date('h:i:s', strtotime($ab->created_at));
                                      @endphp
                                      <b>Written By :-</b> {{ $userInfo->name }}
                                      {{ $ab->created_at->format('H:i:s') }}
                                      <b class="form-control">{{ $ab->comment }}</b>
                                      <br>
                                  @endforeach

                              </div>
                              <br><br><br>
                              <div class="">&nbsp;&nbsp;&nbsp;&nbsp;
                                  {{-- <textarea cols="50" rows="3" style="margin-right: 700px">Add Your Comment</textarea><br><br>
                              <a class="btn btn-success" href="{{ route('login') }}">Submit</a> --}}
                                  <a class="btn btn-secondary" href="/" style="margin-right: 1000px">Back</a>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
      <script>
          < script src = "//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" >
      </script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"
            integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      </script>
      <script>
          $(document).on("click", '#likeblog', function() {
              swal({
                  title: "",
                  text: "Please Login First...!!!",
                  icon: "success",
                  button: ""
              });
          });

          $(document).on("click", '#commentblog', function() {
              swal({
                  title: "",
                  text: "Please Login First...!!!",
                  icon: "success",
                  button: ""
              });
          });
      </script>

  </body>

  </html>
