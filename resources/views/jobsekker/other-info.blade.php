@extends('layouts.main')
@section('body_class','gray')
@section('content')

	<div class="ui container">
				<div class="ui full width user-profile flex">
					@include('partials.jobseeker.profile_left')
					<div class="right">
						<div class="box" id="other_info_show_hide">
							<div class="text header">Other info</div>

							<div class="ui form box">
								<div class="ui flex">
									<div class="info grow-1">
										<div class="detail">
											<div class="row">
												<div class="label">Other information</div>
												<div class="text">
													<div class="ui hide text">
														<div class="content">
														<p>{!!($jobseeker_details->ud_other_info != '') ? nl2br($jobseeker_details->ud_other_info) : 'Not set'!!}</p>
														</div>
														<a class="show-more" data-less-text="Show less" data-more-text="Show more">Show more</a>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="label">Career objective</div>
												<div class="text">{!!($jobseeker_details->ud_objective != '') ? nl2br($jobseeker_details->ud_objective) : 'Not set'!!}</div>
											</div>
										</div>
									</div>
									<div class="actions">
										<button class="ui primary button" onclick="return editOtherInfo();"><i class="edit icon"></i> Edit</button>
									</div>
								</div>
							</div>
						</div>
						 <div class="box" id="edit_other_info_show_hide" style="display:none">
                            <div class="text header">Other info</div>
                            <div class="ui form box">
                                <form class="ui tabular form" id="other_info_form" method="post" action="{{route('jobsekker.otherinfo.update')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="inline field">
                                        <label>Other information</label>
                                        <textarea name="ud_other_info" cols="50" id="ud_other_info"  class="required">{{$jobseeker_details->ud_other_info}}</textarea>
                                    </div>
                                    <div class="inline field">
                                        <label>Career objective</label>
                                        <textarea name="ud_objective" cols="50" id="ud_objective"  class="required">{{$jobseeker_details->ud_objective}}</textarea>
                                    </div>
                                    
                                    <div class="action">
                                        <button type="submit" id="btn-submit" class="ui primary submit button"><i class="save icon"></i> Save</button>
                                       <button type="button" id="btn-cancel" class="ui default  button"><i class="remove icon"></i> Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

					</div>
				</div>
			</div>
@section('modal')
@endsection


@endsection