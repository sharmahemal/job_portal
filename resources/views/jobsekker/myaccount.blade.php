@extends('layouts.main')

@section('body_class','gray')

@section('content')
<div class="content">
	<div class="ui container">
		<div class="ui grid medrect margin-top">
			<div class="sixteen wide column">
				<div class="box">
					<div class="ui grid aligned">
						<div class="four wide column">
							<div class="ui image caption" data-position="bottom">
								<img id="jobsekker_profile_image" src="{{$profile_pic}}" alt="" />
								<form name="photo" id="jobseeker_profile_action" enctype="multipart/form-data" action="{{route('jobsekker.update.profilepic')}}" method="post">
									<input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="file" id="ImageBrowse" name="signFile" style="display:none" accept="image/*">
                                    <input type="submit" name="jobseeker_profile_upload" value="Upload" style="display: none;" />
								</form>
								<a class="caption" href="javascript:void(0);" id="OpenImgUpload" onclick='$("#ImageBrowse").click()'><i class="photo icon"></i> Upload photo</a>
							</div>
						</div>
						<div class="twelve wide column">
							<div class="ui jobseeker profile">
								<div class="name">{{$jobseeker_details->first_name}}</div>
								<div class="email"><a href="mailto::{{$jobseeker_details->user_email }}">{{$jobseeker_details->user_email }}</a></div>
								<div class="qualification">Master Degree, Major in Business Admin</div>
								<div class="graduation">Graudated at Havard University (2012)</div>
							</div>
							
							<form id="form-resume" style="display: none;" enctype="multipart/form-data" action="{{ url('jobseeker/upload/file') }}" method="post">
								{{ csrf_field() }}
								<input type="file" id="btn-resume" name="file">
                                <input type="submit" value="Upload">
							</form>
							
							<div class="actions">
								<a href="{{route('jobsekker.profile')}}" class="ui button blue"><i class="edit icon"></i> Update profile</a>
								<a href="#" class="ui button primary" id="btn-upload"><i class="upload icon"></i> Upload resume</a>
								<a href="#" class="ui button default" data-toggle="modal" data-target="#modal-change-password"><i class="lock icon"></i> Change password</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="ui grid medrect margin-top">
			<div class="sixteen wide column">
				<div class="box">
					<div class="ui top attached tabular menu tabbed">
						<a class="item active" data-tab="preference">Preference jobs</a>
						<a class="item" data-tab="invited">Invited interview</a>
						<a class="item" data-tab="jobs">Job applied</a>
						<a class="item" data-tab="events">My events</a>
						<a class="item" data-tab="saved">Saved jobs</a>
						<a class="item" data-tab="tests">Assessment tests</a>
					</div>
					<div class="ui bottom attached active profile tab segment" data-tab="preference">
						<!-- Copied from the job search.html page -->
						<div class="job-listing preference">
							<div class="box">
								<div class="inner">
									<div class="ui grid">
										<div class="row">
											<div class="eight wide column">
												<a href="job-detail.html" class="title">Web Programmer</a>
											</div>
											<div class="right aligned eight wide column">
												<span class="time">12 hours ago</span>
											</div>
										</div>
										
										<div class="row">
											<div class="four wide column">
												<img class="company logo" src="{{ url('public/img/company/ibm-logo.jpg') }}" alt />
											</div>
											<div class="eight wide column">
												<div class="company title"><a href="company-profile.html">IBM Malaysia (M) Sdn. Bhd.</a></div>
												<div class="company location">Kuala Lumpur</div>
												<div class="salary">RM4,500 - RM5,500</div>
											</div>
											<div class="four wide column">
												<div class="ui social actions">
													<a href class="facebook link"><i class="facebook f icon"></i></a>
													<a href class="twitter link"><i class="twitter icon"></i></a>
													<a href class="linkedin link"><i class="linkedin icon"></i></a>
												</div>
											</div>
										</div>
										<div class="other info row">
											<div class="sixteen wide column">
												<div class="ui horizontal list">
													<a class="item">Full time</a>
													<a class="item">IT web executive</a>
													<a class="item">IT firm</a>
												</div>
												<div class="total views">410 views</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="box">
								<div class="inner">
									<div class="ui grid">
										<div class="row">
											<div class="eight wide column">
												<a href="job-detail.html" class="title">.NET Programmer</a>
											</div>
											<div class="right aligned eight wide column">
												<span class="time">5 days ago</span>
											</div>
										</div>
										
										<div class="row">
											<div class="four wide column">
												<img class="company logo" src="{{ url('public/img/company/main_bastech.jpg') }}" alt />
											</div>
											<div class="eight wide column">
												<div class="company title"><a href="company-profile.html">Main Bastech Sdn. Bhd.</a></div>
												<div class="company location">Petaling Jaya, Selangor</div>
												<a href="#" data-toggle="modal" data-target="#modal-login" class="salary">Login to view salary</a>
											</div>
											<div class="four wide column">
												<div class="ui social actions">
													<a href class="facebook link"><i class="facebook f icon"></i></a>
													<a href class="twitter link"><i class="twitter icon"></i></a>
													<a href class="linkedin link"><i class="linkedin icon"></i></a>
												</div>
											</div>
										</div>
										<div class="other info row">
											<div class="sixteen wide column">
												<div class="ui horizontal list">
													<a class="item">Full time</a>
													<a class="item">IT web executive</a>
													<a class="item">IT firm</a>
												</div>
												<div class="total views">120 views</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="ui pagination menu">
							<a class="active item" href>1</a>
							<a class="item" href>2</a>
							<a class="item" href>3</a>
							<a class="item" href>4</a>
							<a class="item" href>5</a>
							<a class="item" href>6</a>
							<a class="item" href>7</a>
							<a class="item" href>8</a>
							<a class="item" href>9</a>
							<div class="header item">...</div>
							<a class="item" href>22</a>
						</div>
					</div>
					
					<div class="ui bottom attached profile tab segment" data-tab="invited">
						<div class="job-listing preference full-width">
							<div class="box">
								<div class="inner">
									<div class="ui grid">
										<div class="eight wide column">
											<a href="#" class="title">Web Programmer</a>
											<div class="ui grid">
												<div class="four wide column">
													<img class="company logo" src="{{ url('public/img/company/ibm-logo.jpg') }}" alt />
												</div>
												<div class="twelve wide column">
													<div class="company title">IBM Malaysia (M) Sdn. Bhd.</div>
													<div class="company location">Kuala Lumpur</div>
													<div class="job salary">Monthly salary offered: RM4,500 - RM5,500</div>
												</div>
											</div>
										</div>
										<div class="eight wide column right aligned">
											<div class="actions">
												<button type="button" data-toggle="modal" data-target="#modal-accept-interview" class="ui button green"><i class="checkmark icon"></i> Accept interview</button>
												<button type="button" data-toggle="modal" data-target="#modal-reject-interview" class="ui button red"><i class="remove icon"></i> Reject invitation</button>
											</div>
										</div>
									</div>
									<div class="info">
										<div class="job description">
											<p>Lorem ipsum dolor sit amet, odio veniam nam id, ius an nisl ridens, purto reque clita quo an. Ei prima albucius expetendis sit. Simul ornatus maiestatis ex has, ea sit ullum reformidans. Te mucius mandamus expetendis usu, est eu movet tollit honestatis. Impedit vocibus ius no.</p>
											<p>Cu ferri choro admodum est, nam nusquam detracto principes et. Ei malis propriae sea. Graeco iudicabit dissentias eum no, essent labores sit ad. Quo esse modus alienum ut, imperdiet forensibus sea eu, duo iudico facete mnesarchum no. Tota labore in has, quando nostro torquatos no ius, in nec facer accusata dignissim.</p>
										</div>
										<div class="time">2 days ago</div>
									</div>
								</div>
							</div>
							<div class="box">
								<div class="inner">
									<div class="ui grid">
										<div class="eight wide column">
											<a href="#" class="title">C Programmer</a>
											<div class="ui grid">
												<div class="four wide column">
													<img class="company logo" src="{{ url('public/img/company/hp-logo.png') }}" alt />
												</div>
												<div class="twelve wide column">
													<div class="company title">HP Malaysia Sdn. Bhd.</div>
													<div class="company location">Kuala Lumpur</div>
													<div class="job salary">Monthly salary offered: RM2,800 - RM3,800</div>
												</div>
											</div>
										</div>
										<div class="eight wide column right aligned">
											<div class="actions">
												<button type="button" data-toggle="modal" data-target="#modal-accept-interview" class="ui button green"><i class="checkmark icon"></i> Accept interview</button>
												<button type="button" data-toggle="modal" data-target="#modal-reject-interview" class="ui button red"><i class="remove icon"></i> Reject invitation</button>
											</div>
										</div>
									</div>
									<div class="info">
										<div class="job description">
											<p>Lorem ipsum dolor sit amet, odio veniam nam id, ius an nisl ridens, purto reque clita quo an. Ei prima albucius expetendis sit. Simul ornatus maiestatis ex has, ea sit ullum reformidans. Te mucius mandamus expetendis usu, est eu movet tollit honestatis. Impedit vocibus ius no.</p>
											<p>Cu ferri choro admodum est, nam nusquam detracto principes et. Ei malis propriae sea. Graeco iudicabit dissentias eum no, essent labores sit ad. Quo esse modus alienum ut, imperdiet forensibus sea eu, duo iudico facete mnesarchum no. Tota labore in has, quando nostro torquatos no ius, in nec facer accusata dignissim.</p>
										</div>
										<div class="time">2 days ago</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="ui bottom attached profile tab segment" data-tab="jobs">
						<div class="job-listing preference full-width">
							@if ( $userPosts->count() )
								@foreach ( $userPosts as $userPost )
								<div class="box">
									<div class="inner">
										<div class="ui grid">
											<div class="eight wide column">
												<a href="#" class="title">{{ $userPost->post_title }}</a>
												<div class="ui grid">
													<div class="four wide column">
														@if ( $userPost->company_avatar )
														<img class="company logo" src="{{ url('public/uploads/employer/' . $userPost->company_id . '/' . $userPost->company_avatar) }}" alt="" />
														@else
														<img class="company logo" src="{{ url('public/img/company/job-logo2.jpg') }}" alt="" />
														@endif
													</div>
													<div class="twelve wide column">
														<div href="#" class="company title">{{ $userPost->comapny_name }}</div>
														<div class="company location">Kuala Lumpur</div>
														<div class="job salary">Salary requested: RM{{ $userPost->salary }}</div>
													</div>
												</div>
											</div>
											<div class="eight wide column right aligned">
												<div class="actions">
													<button class="ui button blue">View my answers</button>
													<button type="button" data-toggle="modal" data-target="#modal-cancel-application" class="ui button red btn-cancel-application" data-id="{{ $userPost->post_id }}"><i class="remove icon"></i> Cancel application</button>
												</div>
											</div>
										</div>
										<div class="info">
											<div class="job description">
												{!! nl2br($userPost->post_desc) !!}
											</div>
											<div class="time text small">{{ $userPost->created_at }}</div>
										</div>
									</div>
								</div>
								@endforeach
							@else
							No jobs applied at the moment.
							@endif
						</div>
					</div>
					
					<div class="ui bottom attached event tab segment" data-tab="events">
						<div class="ui event listing">
							<div class="item">
								<div class="ui jumbotron" data-background="{{ url('public/img/event/event01.jpg') }}" data-dim="0.6">
									<div class="title">2017 Jobs Fair on June</div>
									<div class="sub title">Over 300 employers available in this grand event! Participate and get gift worth RM500!</div>
								</div>
								<br /><br />
								<div class="ui grid">
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Location:</strong>
										</div>
										<div class="fourteen wide column">
											Mid Valley Convention Centre Hall, Level 5<br />
											<a href="#"><i class="marker icon"></i> Get direction</a>
										</div>
									</div>
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Date/time:</strong>
										</div>
										<div class="fourteen wide column">
											1/5/2017 12PM - 10PM
										</div>
									</div>
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Registered at:</strong>
										</div>
										<div class="fourteen wide column">
											12/4/2017 6:15PM
										</div>
									</div>
								</div>
								<div class="actions">
									<button type="button" class="ui button red"><i class="remove icon"></i> Cancel</button>
								</div>
							</div>
							
							<div class="item">
								<div class="ui jumbotron" data-background="{{ url('public/img/event/event01.jpg') }}" data-dim="0.6">
									<div class="title">2017 Jobs Fair on June</div>
									<div class="sub title">Over 300 employers available in this grand event! Participate and get gift worth RM500!</div>
								</div>
								<br /><br />
								<div class="ui grid">
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Location:</strong>
										</div>
										<div class="fourteen wide column">
											Mid Valley Convention Centre Hall, Level 5<br />
											<a href="#"><i class="marker icon"></i> Get direction</a>
										</div>
									</div>
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Date/time:</strong>
										</div>
										<div class="fourteen wide column">
											1/5/2017 12PM - 10PM
										</div>
									</div>
									<div class="row">
										<div class="two wide column right aligned">
											<strong>Registered at:</strong>
										</div>
										<div class="fourteen wide column">
											12/4/2017 6:15PM
										</div>
									</div>
								</div>
								<div class="actions">
									<button type="button" class="ui button red"><i class="remove icon"></i> Cancel</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="ui bottom attached profile tab segment" data-tab="saved">
						@if ( $savedPosts && $savedPosts->count() )
						<div class="job-listing preference">
							@foreach ( $savedPosts as $post )
							<div class="box">
								<div class="inner">
									<div class="ui grid">
										<div class="row">
											<div class="eight wide column">
												<a href="job-detail.html" class="title">{{ $post->post_title }}</a>
											</div>
											<div class="right aligned eight wide column">
												<a class="active bookmark" data-toggle="delete-bookmark" data-value="{{ $post->id }}"><i class="star icon"></i></a>
											</div>
										</div>
										
										<div class="row">
											<div class="four wide column">
												<img class="company logo" src="{{ url('public/img/company/ibm-logo.jpg') }}" alt />
											</div>
											<div class="eight wide column">
												<div class="company title"><a href="company-profile.html">{{ $post->post_title }}</a></div>
												<div class="company location">{{ $post->post_city }}</div>
												<div class="salary">RM{{ number_format($post->post_salary_min) }} - RM{{ number_format($post->post_salary_max) }}</div>
											</div>
											<div class="four wide column">
												<div class="ui social actions">
													<a href class="facebook link"><i class="facebook f icon"></i></a>
													<a href class="twitter link"><i class="twitter icon"></i></a>
													<a href class="linkedin link"><i class="linkedin icon"></i></a>
												</div>
											</div>
										</div>
										<div class="other info row">
											<div class="sixteen wide column">
												<div class="ui horizontal list">
													<a class="item">{{ $post->post_type }}</a>
													<a class="item">{{ $post->post_category }}</a>
													<a class="item">{{ $post->post_level }}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						
						{{ $savedPosts->links() }}
						@else
						<div class="ui empty message">You did not saved any job yet.</div>
						@endif
					</div>
					
					<div class="ui bottom attached tab segment" data-tab="tests">
						Coming soon
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ui small modal" id="modal-change-password">
	<div class="header">Change Password</div>
	<div class="content">
		<form class="ui tabular longer-label form" id="form-password" action="{{ url('jobseeker/change-password') }}" method="post">
			{{ csrf_field() }}
			<div class="inline field">
				<label>Enter your current password:</label>
				<input type="password" name="current_password" value="" />
			</div>
			<div class="inline field">
				<label>Enter your new password:</label>
				<input type="password" name="new_password" value="" />
			</div>
			<div class="inline field">
				<label>Retype your new password:</label>
				<input type="password" name="retype_password" value="" />
			</div>
		</form>
	</div>
	<div class="actions">
		<button type="button" id="btn-change-password" class="ui primary button">Change Password</button>
		<button type="button" class="ui default button close">Cancel</button>
	</div>
</div>

<div class="ui basic modal" id="modal-cancel-application">
	<div class="ui icon header">
		<i class="trash icon"></i>
		Cancel Application
	</div>
	<div class="content">
		<p>Are you sure to cancel this job application?</p>
	</div>
	<div class="actions">
		<button type="button" id="btn-cancel-application" class="ui primary button">Yes</button>
		<button type="button" class="ui default button close">Cancel</button>
	</div>
</div>
@endsection

@section('script')
<script src="{{ url('public/js/blog.js') }}"></script>
<script type="text/javascript">
$(document).ready(function (e) {
    $('#jobseeker_profile_action').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var imgclean = $('#ImageBrowse');
        var imgname  =  $('#ImageBrowse').val();
        var size  =  $('#ImageBrowse')[0].files[0].size;
        var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) ).toLowerCase();
        if($.inArray(ext,['jpg','jpeg','gif'])===-1)
        {   
            alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
            return false;
        }else if(size >= 1000000){ //less then 1MB
            alert('Sorry File size exceeding from 1 Mb');
            return false;
        }
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                var loader_url = "{{url('public/uploads/clock-loading.gif')}}";
                $('#jobsekker_profile_image').attr('src',loader_url);
            },
            success: function(response){
                $('#jobsekker_profile_image').attr('src',response.profileImage);
            },
            error: function(jqXHR, exception){
               
            }
        });
    }));

    $("#ImageBrowse").on("change", function() {
        $("#jobseeker_profile_action").submit();
    });

    $("#btn-change-password").click(function() {
        var form = $("#form-password");
        var formData = $(form).serialize();

        $.ajax({
            url: $(form).attr("action"),
            type: $(form).attr("method"),
            dataType: "json",
            data: formData,
            success: function(data) {
                if ( data.success ) {
                    alert("Your password has been updated.");

                    $("#modal-change-password").modal("hide");
                } else {
                    alert(data.message);
				}
            }
        });
    });

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


    var applicationId = 0;
    
    $(".btn-cancel-application").click(function() {
        var id = $(this).data("id");

        applicationId = id;
    });

    $("#btn-cancel-application").click(function(e) {
        if ( applicationId ) {
            $.ajax({
                url: "{{ url('jobseeker/cancel/application') }}",
                type: "post",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": applicationId
                },
                success: function(data) {
                    if ( data.success ){
                        alert("The application has been removed.");
                        window.location.reload(true);
                    }
                }
            });
        }
    });

    $("[data-toggle='delete-bookmark']").click(function(e) {
    	e.preventDefault();

		if ( $(this).data("bookmarking") ) {
			return ;
		}
		
		var id = $(this).data("value");
		var data = {
			status: false,
			id: id,
			"_token": "{{ csrf_token() }}"
		};

		$(this).data("bookmarking", true);
			
		$.ajax({
			url: "{{ url('jobseeker/post/bookmark') }}",
			type: "post",
			dataType: "json",
			data: data,
			context: this,
			success: function(data) {
				if ( data.success ) {
					$(this).closest(".box").fadeOut();
				}
			},
			complete: function() {
				$(this).data("bookmarking", false);
			}
		});
    });
});
</script>
@endsection