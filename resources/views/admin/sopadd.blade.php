@section('title', 'Add SOP')
@extends('admin/admin-theme')

@section('content')

<div class="row">
    <div class="col-12">

        <!-- general form elements -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Add SOP</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="saveSOP" >
                <div class="card-body">
                    <div class="msg-alert"></div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Devision</label>
                        <select name="devision" class="form-control select2" style="width: 100%;">
                            <option value="">Pilih Devision</option>
                            <option value="Technical" >Technical</option>
                            <option value="Developer" >Developer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">SOP</label>
                        <textarea class="editor" name="sop" placeholder="SOP"></textarea>
                    </div>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                     <a title="selesai" href="{{ url('admin/sop') }}" class="btn btn-success">Finish</a>
                    <button title="simpan" type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </div>
</div>
<script type="text/javascript"  >
    $( document ).ready(function() {
        
        $("#saveSOP").submit(function(){
		var xajaxFile = "{{ url('admin/sop/ajax-save') }}";
		$('.msg-alert').html('');
		$.ajax({
			
			type: 'POST',
			url: xajaxFile,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: $("#saveSOP").serialize(),
			dataType: 'json',
			success: function(data){
				
				if(!data.error){
					
					$(":input","#saveSOP")
					.not(":button, :submit, :reset, :hidden")
					.val("")
					.removeAttr("checked")
					.removeAttr("selected");

                    $(".select2").removeAttr("selected");
                    $(".editor").val("");
					$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
				}
				else{
					$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> '+data.alert+"</div>");
				}
			}
		});
		return false;
	});



    });
</script>

@endsection

