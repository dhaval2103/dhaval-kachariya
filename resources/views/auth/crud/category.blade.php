
@extends('auth.layout.master')

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
          <div class="card">
            <div class="card-header">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
                            @if(Session::has('add_category'))
                            <span>{{ Session::get('add_category') }}</span>
                            @endif
                          <form  method="POST" enctype="multipart/form-data" id="register">
                            @csrf
                            <input type="hidden" class="form-control" id="frmid" name="frmid">
                            <div class="alert alert-success d-none" id="msg_div">
                                <span id="res_message"></span>
                               </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Title :</label>
                              <input type="text" class="form-control" id="title" name="title">
                              @error('title')
                              <span style="color: red">{{ $message }}</span>
                          @enderror
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">Description :</label>
                              <textarea class="form-control" id="description" name="description"></textarea>
                              @error('description')
                              <span style="color: red">{{ $message }}</span>
                          @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image :</label><br>
                                <input type="file" name="image" id="image">
                                @error('image')
                              <span style="color: red">{{ $message }}</span>
                          @enderror
                              </div>
                              <div>
                                <img src="" id="imageshow" alt="" height="100px">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="butttn" class="btn btn-primary update" id="addbutton" >Submit</button>
                                {{--  <input type="submit" name="submit" value="submit">  --}}
                                <div id="msgdisplay"></div>
                              </div>
                          </form>
                        </div>

                      </div>
                    </div>
                  </div>
                <button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add Category</button>
            </div>
            <div class="card-body">
                {{ $dataTable->table(['class'=>'table table-bordered dt-responsive nowrap']) }}
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

    $(document).on("click",'.add', function(){

        $('#title').val('');
        $('#frmid').val('');
        $('#description').val('');
        $('#imageshow').prop('src','');

});

    $("#register").validate({
        rules:{
            'title':{required:true},
            'description':{required:true},
           // 'image':{required:true},
        },
        messages:{
            'title':{required:"Please Enter Title..!!!"},
            'description':{required:"Please Enter Description..!!!"},
            //'image':{required:"Please Choose Image..!!!"},
        },
        submitHandler: function(form){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.insert') }}",
                data:new FormData(form),
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data){
                    if(data==1)
                    {
                        $('#categorydatatable-table').DataTable().ajax.reload();
                        $('#exampleModal').modal('hide');
                        toastr.success('Category Update Successfully');
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
    $("#exampleModal").on('hide.bs.modal',function(){
        $(".error").empty();
    });

        $(document).on("click",'#deletedata', function(){
            var id = $(this).data('id');
            var element = this;
            if (confirm("Are You Sure Want To Delete This...?")) {
              $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.delete') }}",
                dataType: "json",
                data: {
                  id: id
                },
                success: function(response) {
                  $(element).closest('tr').fadeOut();
                  toastr.error('category Delete Successfully');
                }
              });
            } else {
              return false;
            }
        });


        $(document).on("click",'#editdata', function(){
            var id = $(this).data('id');
              $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: "post",
                url: "{{ route('crud.edit') }}",
                dataType: "json",
                data: {
                  id: id
                },
                success: function(response) {
                    console.log(response);
                  $('#exampleModalLabel').html('Category');
                  $('#title').val(response.title);
                  $('#frmid').val(response.id);
                  $('#description').val(response.description);
                  $('#imageshow').attr('src',response.image);
                  //toastr.success('Category Update Successfully');
                }
              });
        });

</script>
@endpush
