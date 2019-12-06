@section('title', 'Add SOP')
@extends('admin/admin-theme')

@section('content')
<script type="text/javascript" src="{{ URL::asset('assets/plugin/upload.file.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/plugin/ckeditor/ckeditor/ckeditor.js') }}"></script>

<div class="row">
	<div class="col-12">
		<!-- general form elements -->
		<div class="card card-default">
			<div class="card-header">
				<h3 class="card-title">Form Add SOP</h3>
			</div>
			<!-- /.card-header -->
			<!-- form start -->
			<form role="form" id="saveSOP" action="" enctype="multipart/form-data">
				<div class="card-body">
					<div class="msg-alert"></div>
					<div class="row">
						<div class="col-md-9 col-12 col-sm-12">
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="Title">
							</div>
							<div class="form-group">
								<label>Devision</label>
								<select name="devision" class="form-control select2" style="width: 100%;">
									<option value="">Pilih Devision</option>
									<option value="Technical">Technical</option>
									<option value="Developer">Developer</option>
								</select>
							</div>
							<div class="form-group">
								<label for="title">SOP</label>
								<textarea class="editor" id="sop" name="sop" placeholder="SOP"></textarea>
							</div>
							<script type="text/javascript">
								var neditor = CKEDITOR.replace( "sop" );
							</script>
						</div>
						<div class="col-md-3 col-12 col-sm-12">
							<!--- upload images --->
							<script type="text/javascript">
								function changeClassimages(set) {
									var uploadbtn = document.getElementById('button_images');
									uploadbtn.className = set;
								}

								function hidemsg_images() {
									$("#msg_images").fadeOut("slow");
								}

								function upload_images() {

									var uploadbtn = document.getElementById('button_images');
									uploadbtn.className = 'off';

									$(".loading_images").fadeIn();

									$.ajaxFileUpload({
										type: 'POST',
										url: '{{url("/ajax/upload-img")}}',
										headers: {
											'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										},
										secureuri: false,
										fileElementId: 'images',
										data: $.param({
											name: 'images'
										}),
										dataType: 'json',
										success: function(data, status) {
											if (typeof(data.error) != 'undefined') {
												if (data.error != '') {
													$(".loading_images").hide();
													$("#msg_images").html(data.error);
													$("#msg_images").fadeIn("slow");
												} else {
													$(".loading_images").hide();
													document.getElementById("file_images").value = data.fileName;
													$("#preview_images").html(data.msg);
													$("#preview_images").fadeIn("slow");
												}
											}
											$("input:file").val("");
										},
										error: function(data, status, e) {
											alert(e);
											$("input:file").val("");
										}
									})

									return false;
								}

								function removeFile_images() {
									// $( document ).ready(function() {
									$("#preview_images").html('');
									$("#file_images").val('');
									$("#btn_remove_images").hide();
									$("#btn_restore_images").show();
									return false;
									// });
								}

								function restoreFile_images() {
									$("#preview_images").html('<img src="{{ URL::asset("assets/img/default.jpg")  }}">');
									$("#file_images").val("{{ URL::asset('assets/img/default.jpg')  }}");
									$("#btn_restore_images").hide();
									$("#btn_remove_images").show();
									return false;
								}
							</script>
							<div class="form-group">
								<label class="control-label">Upload images</label>
								<div class="upload-file ">

									<div class="preview">
										<div id="preview_images"><img src="{{ URL::asset('assets/img/default.jpg')  }}" /></div>
									</div>
									<span class="bg-transparent"></span>
									<div class="upload-file-input">
										<!-- <a id="btn_remove_images" href="javascript:void(0)" class="delFile" onclick="return removeFile_images()"><i class="fa fa-trash"></i></a> -->
										<a id="btn_restore_images" href="javascript:void(0)" class="restoreFile" onclick="return restoreFile_images()" style="display:none"><i class="fa fa-reply"></i></a>

										<p class="button">
											<button id="button_images" class="off"><i class="fa fa-upload"></i></button>
											<input type="file" id="images" name="file" style="
										font-size: 50px;
										position: absolute;
										opacity: 0; 
										filter:alpha(opacity: 0);
										right: 0;
										top: -1px;
										height:100px;
									" onMouseOver="changeClassimages('on')" onMouseOut="changeClassimages('off')" onChange="return upload_images();" onClick="return hidemsg_images();">
										</p>

										<!-- <input type="hidden" name="postImages[field][]" value="images"> -->
										<input type="hidden" name="postImages[path]" value="{{ public_path('assets/images/')}}">
										<input type="hidden" name="postImages[name]" id="file_images" value="">
										<!--<input type="hidden" name="postImages[filename][]" value=""> -->
									</div>
								</div>
							</div>

								<!--- // upload images --->
								<!------------------- upload file ---->

								<?php
								$name = 'file';
								$allowedTypes = 'pdf';
								$maxsize = '';
								?>
								<script type="text/javascript">
									function upload_<?= $name ?>() {

										$('.upload-info-<?= $name ?>').attr('data-title', 'Uploading ...');

										$.ajaxFileUpload({
											type: 'POST',
											url: '{{url("/ajax/upload-file")}}',
											headers: {
												'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
											},
											secureuri: false,
											fileElementId: '<?= $name ?>',
											data: $.param({
												name: '<?= $name ?>'
											}),
											dataType: 'json',
											success: function(data, status) {
												if (typeof(data.error) != 'undefined') {
													if (data.error != '') {
														$('.upload-info-<?= $name ?>').attr('data-title', data.error);
														$('.upload-info-<?= $name ?>').html('<i class="ace-icon fa fa-upload"></i>');
														$('#btn-upload-<?= $name ?>').removeClass('selected');
														$('#btn-upload-<?= $name ?>').attr('data-title', 'Choose');
														$('#file_<?= $name ?>').val('');
													} else {
														$('.upload-info-<?= $name ?>').attr('data-title', data.fileName);
														$('.upload-info-<?= $name ?>').html('<i class="ace-icon fa ' + data.fileIcon + '"></i>');
														$('#btn-upload-<?= $name ?>').addClass('selected');
														$('#btn-upload-<?= $name ?>').attr('data-title', 'Change');
														$('#file_<?= $name ?>').val(data.fileUpload);
													}
												}
												$("input:file").val("");
											},
											error: function(data, status, e) {
												alert(e);
												$("input:file").val("");
											}
										})

										return false;
									}

									function removeFile_<?= $name ?>() {
										$("#file_<?= $name ?>").val('');
										$('.upload-info-<?= $name ?>').attr('data-title', 'No File ...');
										$('.upload-info-<?= $name ?>').html('<i class="ace-icon fas fa-upload"></i>');
										$('#btn-upload-<?= $name ?>').removeClass('selected');
										$('#btn-upload-<?= $name ?>').attr('data-title', 'Choose');
										return false;
									}
								</script>
								<div class="form-group">
									<label class="control-label">File <small class="text-warning">pdf</small></label>
									<div class="controls">
										<label class="ace-file-input">
											<input type="file" id="file" name="file" onChange="return upload_file();" />
											<span id="btn-upload-file" data-title="Choose" class="ace-file-container">
												<span data-title="No File ..." class="ace-file-name upload-info-file">
													<i class="ace-icon fa fa-upload'"></i>
												</span>
											</span>
											<a href="javascript:void(0)" class="remove btn_remove_file" onclick="return removeFile_file()"><i class=" ace-icon fa fa-times"></i></a>
										</label>
									</div>

									<input type="hidden" name="postFiles[field]" value="file">
									<input type="hidden" name="postFiles[path]" value="{{ public_path('assets/file/')}}">
									<input type="hidden" name="postFiles[name]" id="file_file" value="">
									<input type="hidden" name="postFiles[filename]" value="">

									<div class="loading_images progress-upload progress progress-small progress-striped active" style="display:none;margin-top:10px;">
										<div style="width: 100%;" class="progress-bar progress-bar-warning"></div>
									</div>
									<div id="msg_images" style="display:none;"></div>
								</div>
								<!-------------------- // upload file --------------------->

							</div>
						</div>
						<!-- row -->
					</div>
				</div>
				<!----- // upload images --->
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
<script type="text/javascript">
	$(document).ready(function() {

		$("#saveSOP").submit(function() {
			var xajaxFile = "{{ url('admin/sop/ajax-save') }}";
			$('.msg-alert').html('');
			$.ajax({

				type: 'POST',
				url: xajaxFile,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: $("#saveSOP").serialize(),
				dataType: 'json',
				success: function(data) {

					if (!data.error) {
						$(".editor").val('');
						$("#preview_images").html('');
						$("#preview_images").html('<img src="{{ URL::asset("assets/img/default.jpg")  }}">');
						$(".upload-info-file").removeAttr("data-title");
						$(".upload-info-file").attr("data-title", "No File");
						$(".file_file").val('');
						$("textarea").val('');
						$(":input", "#saveSOP")
							.not(":button, :submit, :reset, :hidden")
							.val("")
							.removeAttr("checked")
							.removeAttr("selected");

						$(".select2").removeAttr("selected");
						$(".editor").val("");
						$(".msg-alert").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-ok-circle iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
					} else {
						$(".msg-alert").html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-exclamation-sign iconleft" aria-hidden="true"></span> ' + data.alert + "</div>");
					}
				}
			});
			return false;
		});



	});
</script>

@endsection