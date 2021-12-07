@extends('auth.layout.master')

@section('content');
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Your Blog</h1>
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
                <form enctype="multipart/form-data" id="register">
                    @csrf
                    <input type="hidden" class="form-control" id="frmid" name="frmid">
                    <div class="alert alert-success d-none" id="msg_div">
                        <span id="res_message"></span>
                       </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Blog Title :</label>
                      <input type="text" class="form-control" id="title" name="title">
                      @error('title')
                      <span style="color: red">{{ $message }}</span>
                  @enderror
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Blog Description :</label>
                      <textarea class="form-control" id="description" name="description"></textarea>
                      @error('description')
                      <span style="color: red">{{ $message }}</span>
                  @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Blog Image :</label><br>
                        <input type="file" name="image" id="image">
                        @error('image')
                      <span style="color: red">{{ $message }}</span>
                  @enderror
                      </div>

                      <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="addbutton" value="Submit">
                        {{--  <input type="submit" name="submit" value="submit">  --}}
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

 /* $(document).on("click",'.add', function(){

        $('#title').val('');
        $('#frmid').val('');
        $('#description').val('');
        $('#imageshow').prop('src','');

  }); */

    $("#register").validate({
        rules:{
            'title':{required:true},
            'description':{required:true},
            'image':{required:true},
        },
        messages:{
            'title':{required:"Please Enter Blog Title..!!!"},
            'description':{required:"Please Enter Blog Description..!!!"},
            'image':{required:"Please Choose Image..!!!"},
        },
        submitHandler: function(form){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.bloginsert') }}",
                data:new FormData(form),
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data){
                    if(data==1)
                    {
                       // ('#register').ajax.reload();
                        toastr.success('Blog Add Successfully');
                        location.reload();
                    }

                },
                error:function(response)
                {
                    $.each(response.responseJSON.errors,function(field_name,errors){
                    $('[name='+field_name+']').after('<span class="text-strong" style="color:red">' +errors+ '</span>')
                    })
                }
            });
        }
    });
  /*  $("#exampleModal").on('hide.bs.modal',function(){
        $(".error").empty();
    }); */



</script>
@endpush
