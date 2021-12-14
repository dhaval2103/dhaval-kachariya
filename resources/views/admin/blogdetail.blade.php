@extends('admin.layout.master')
@section('content');
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View User Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
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
                                {{-- @php
                                    $userInfo = DB::table('users')
                                        ->where('id', $querys->user_id)
                                        ->first();
                                @endphp

                                <center><b style="color:black">{{ $userInfo->name }}</b></center> --}}

                                <div id="{{ $querys->id }}">

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
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

@endsection
