@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
	<div class="ui full width user-profile flex">
		@include('partials.jobseeker.profile_left')
		<div class="right">
			<div class="box">
				<div class="text header">Resumes</div>
				@if ( $jobseeker->resumes()->count() )
				<div class="ui list">
					@foreach ( $jobseeker->resumes as $resume )
					<div class="item">
						<i class="file icon"></i>
						<div class="content">
							<div class="header"><a target="resume_{{ $resume->id }}" href="{{ $resume->link() }}">{{ $resume->default_filename }}</a>
									<a data-id="{{ $resume->id }}" class="text red delete-resume" href="#"><i class="trash icon"></i></a>
								</div>
							<div class="description">
								{{ date('j/n/Y H:i:s', strtotime($resume->created_at)) }}
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@else
				<div class="ui empty message">No resume uploaded at the moment.</div>
				@endif
				
				<form id="form-resume" style="display: none;" enctype="multipart/form-data" action="{{ url('jobseeker/upload/file') }}" method="post">
					{{ csrf_field() }}
					<input type="file" id="btn-resume" name="file">
					<input type="submit" value="Upload">
				</form>
				<div class="actions">
					<a href="#" class="ui button primary" id="btn-upload"><i class="upload icon"></i> Upload resume</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
$("#btn-upload").click(function() {
    $("#btn-resume").trigger("click");
});

$("#btn-resume").on("change", function() {
    var form = $(this).closest("form").get(0);
    var formData = new FormData(form);
    var filename = $(this).val();
    var file = $(this).get(0).files[0];
    var filesize = file.size;
    var ext =  filename.substr( (filename.lastIndexOf('.') +1) ).toLowerCase();

    if ( !$.inArray(ext, ["doc", "docx", "pdf"]) ) {
        alert("Invalid file format. Only Word and PDF allowed.");
        return ;
   	} else if ( filesize > 2 * 1024 * 1024 ) {
       	alert("Maximum filesize up to 2MB.");
       	return ;
    }

    $("#btn-upload").prop("disabled", true);
    
    $.ajax({
        type:$(form).attr("method"),
        url: $(form).attr("action"),
        data:formData,
        dataType: "json",
        // cache:false,
        contentType: false,
        processData: false,
        beforeSend: function(){
        	$("#btn-upload").prop("disabled", true);
        },
        success: function(data){
            if ( data.success) {
                alert("Resume file uploaded!");
                window.location.reload(true);
            } else {
            	alert("Unable to upload your resume at this moment. Please contact our system administrator.");
            }
        },
        error: function(jqXHR, exception){
        	alert("Unable to upload your resume at this moment. Please contact our system administrator.");
        },
        complete: function() {
        	$("#btn-upload").prop("disabled", false);
        }
    });
});

$(".delete-resume").click(function() {
    var id = $(this).data("id");

    if ( !confirm("Do you wish to delete this resume?") ) {
        return false;
    }

    $.ajax({
        url: "{{ url('/jobseeker/resume/delete') }}",
        type: "post",
        dataType: "json",
       	data: {
           	"_token": "{{ csrf_token() }}",
           	"id": id
        },
        success: function(data) {
            if ( data.success ) {
                alert("Resume has been deleted!");
                window.location.reload(true);
            }
        }
    });
});
</script>
@endsection