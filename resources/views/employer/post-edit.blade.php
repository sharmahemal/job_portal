@extends('layouts.main')
@section('body_class','gray')
@section('content')
<style>
.help-block.form-error {
  display: none;
}
</style>
<div class="ui container">
				<div class="ui full width flex employer content">
					@include('partials.employer.emp-left')	
					
					<div class="right full">
						<div class="box">
							<h2>Edit Post: {{ $post->post_title }}</h2>
							<form class="ui tabular form" id="employer_post" name="employer_post" method="post" action="{{ url('employer/post/' . $post->id) }}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="inline field">
									<label>* Job title</label>
									<input type="text" name="post_title" data-validation="required" value="{{ $post->post_title }}" id="post_title" size="50" placeholder="Eg: HR Manager, Java Programmer, Sales Promoter" />
								</div>
								<div class="inline field">
									<label>* Job type</label>
									<div class="ui selection dropdown">
										<input type="hidden" name="post_type" value="{{ $post->post_type }}" id="post_type" data-validation="required"/>
										<div class="default text">Select a job type</div>
										<i class="dropdown icon"></i>
										<div class="menu">
											<div class="item" data-value="Full time">Full time</div>
											<div class="item" data-value="Part time">Part time</div>
											<div class="item" data-value="Contact">Contact</div>
											<div class="item" data-value="Internship">Internship</div>
										</div>
									</div>
								</div>
								
								<div class="inline field">
									<label>* Job category</label>
									<div class="ui selection grow-1 search dropdown">
										<input type="hidden" name="post_category" value="{{ $post->post_category }}" data-validation="required" id="post_category">
										<i class="dropdown icon"></i>
										<div class="default text">Select a category</div>
										<div class="menu">
											<div class ="item" data-value="Food">Food</div>
											<div class ="item" data-value="General Manufacturing">General Manufacturing</div>
											<div class ="item" data-value="Mechanical">Mechanical</div>
											<div class ="item" data-value="Medical">Medical</div>
											<div class ="item" data-value="Metal">Metal</div>
											<div class ="item" data-value="Petrochemical &amp;Polymer">Petrochemical &amp;Polymer</div>
											<div class ="item" data-value="Rubber">Rubber</div>
											<div class ="item" data-value="Textile">Textile</div>
											<div class ="item" data-value="Wood">Wood</div>
											
											<div class="header">Marketing</div >
											<div class ="item" data-value="Advertising">Advertising</div>
											<div class ="item" data-value="Brand Management">Brand Management</div>
											<div class ="item" data-value="Event">Event</div>
											<div class ="item" data-value="Market Research">Market Research</div>
											<div class ="item" data-value="Marketing">Marketing</div>
											<div class ="item" data-value="Public Relations">Public Relations</div>
											
											<div class="header">Media</div >
											<div class ="item" data-value="Broadcasting">Broadcasting</div>
											<div class ="item" data-value="Creative &amp;Interactive Media">Creative &amp;Interactive Media</div>
											<div class ="item" data-value="Journalism">Journalism</div>
											<div class ="item" data-value="New Media">New Media</div>
											<div class ="item" data-value="Publishing">Publishing</div>
											
											<div class="header">Plant &amp;Animal</div >
											<div class ="item" data-value="Agriculture">Agriculture</div>
											<div class ="item" data-value="Animal Care">Animal Care</div>
											<div class ="item" data-value="Farming">Farming</div>
											
											<div class="header">Property</div >
											<div class ="item" data-value="Building Management">Building Management</div>
											<div class ="item" data-value="Real Estate Management">Real Estate Management</div>
											
											<div class="header">Retail</div >
											<div class ="item" data-value="Distribution Channels">Distribution Channels</div>
											<div class ="item" data-value="Merchandising">Merchandising</div>
											<div class ="item" data-value="Retail Buying">Retail Buying</div>
											<div class ="item" data-value="Store Operation">Store Operation</div>
											
											<div class="header">Sales </div >
											<div class ="item" data-value="Sales">Sales</div>
											
											<div class="header">Security &amp;Defence</div >
											<div class ="item" data-value="Defence">Defence</div>
											<div class ="item" data-value="Security">Security</div>
											
											<div class="header">Services</div >
											<div class ="item" data-value="Beauty">Beauty</div>
											<div class ="item" data-value="Language">Language</div>
											<div class ="item" data-value="Other Services">Other Services</div>
											
											<div class="header">Sports</div >
											<div class ="item" data-value="Event">Event</div>
											<div class ="item" data-value="Facility">Facility</div>
											<div class ="item" data-value="Training/Coaching">Training/Coaching</div>
										</div>
									</div>
								</div>
									
								<div class="inline field">
									<label>* Job level</label>
									<div class="ui selection dropdown">
										<input type="hidden" name="post_level" value="{{ $post->post_level }}" data-validation="required" id="post_level">
										<i class="dropdown icon"></i>
										<div class="default text">Select a level</div>
										<div class="menu">
											<div class="item" data-value="Fresh graduated">Fresh graduated</div>
											<div class="item" data-value="Non executive">Non executive</div>
											<div class="item" data-value="Executive">Executive</div>
											<div class="item" data-value="Senior executive">Senior executive</div>
											<div class="item" data-value="Manager">Manager</div>
											<div class="item" data-value="Top management">Top management</div>
										</div>
									</div>
								</div>
								
								<div class="inline field">
									<label>* Position</label>
									<input type="text" name="post_position" id="post_position" data-validation="required" size="35" placeholder="Eg: International sales executive" value="{{ $post->post_position }}" />
								</div>
									
								<div class="inline field">
									<label>* Job description</label>
									<textarea name="post_desc" id="post_desc" data-validation="required" cols="50" rows="10">{{ $post->post_desc }}</textarea>
								</div>
								
								<div class="ui divider"></div>
								<div id="map" class="ui map"></div>
								<input type="hidden" id="lat" name="post_lat" value="{{ $post->post_lat }}" />
								<input type="hidden" id="long" name="post_long" value="{{ $post->post_long }}" />
							
								<div class="inline field">
									<label>* Country:</label>
									<div class="ui selection dropdown" id="country">
										<input type="hidden" value="{{ $post->post_country }}" name="post_country" id="post_country" data-validation="required" />
										<div class="default text">Country</div>
										<i class="dropdown icon"></i>
										<div class="menu">
											<div class="item" data-value="Malaysia">Malaysia</div>
											
										</div>
									</div>
								</div>
								
								<div class="inline field">
									<label>* State:</label>
									<div class="ui selection dropdown" >
										<input type="hidden" id="post_state" value="{{ $post->post_state }}" data-validation="required" name="post_state"/>
										<div class="default text">State</div>
										<i class="dropdown icon"></i>
										<!-- If the user selected a country that is not in Malaysia, please allow them to type in the state by themself -->
										<div class="menu">
											<div class="item" data-value="Kuala Lumpur">Kuala Lumpur</div>
											<div class="item" data-value="Labuan">Labuan</div>
											<div class="item" data-value="Putrajaya">Putrajaya</div>
											<div class="item" data-value="Johor">Johor</div>
											<div class="item" data-value="Kedah">Kedah</div>
											<div class="item" data-value="Kelantan">Kelantan</div>
											<div class="item" data-value="Malacca">Malacca</div>
											<div class="item" data-value="Negeri Sembilan">Negeri Sembilan</div>
											<div class="item" data-value="Pahang">Pahang</div>
											<div class="item" data-value="Penang">Penang</div>
											<div class="item" data-value="Perak">Perak</div>
											<div class="item" data-value="Perlis">Perlis</div>
											<div class="item" data-value="Sabah">Sabah</div>
											<div class="item" data-value="Sarawak">Sarawak</div>
											<div class="item" data-value="Sarawak">Selangor</div>
											<div class="item" data-value="Terrengganu">Terrengganu</div>
										</div>
									</div>
									<!-- <input type="text" name="state_other" id="state-other" size="35" class="hidden" placeholder="Enter the state name..." /> -->
								</div>
								
								<div class="inline field">
									<label>* City</label>
									<input type="text" name="post_city" data-validation="required" value="{{ $post->post_city }}" id="post_city" size="15" />
								</div>
									
								<div class="inline field">
									<label>* Address</label>
									<textarea name="post_address" id="post_address" data-validation="required" cols="50" rows="3">{{ $post->post_address }}</textarea>
								</div>
									
								<div class="inline field">
									<label>* Postcode</label>
									<input type="text" name="post_postalcode" maxlength="5" data-validation="number" value="{{ $post->post_postalcode }}" id="post_postalcode" size="15" />
								</div>
							
								<div class="ui divider"></div>
								<?php $post_tech_skill = explode(',',$post->post_tech_skill);?>
								<?php $post_tech_experience = explode(',',$post->post_tech_experience);?>
								<div class="ui repeating group">
									<div class="inline field">
										<label>Job skill #<span class="number">1</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" value="{{ $post_tech_skill[0] }}" name="post_tech_skill[]" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select a job skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Audit Software">Audit Software</div>
												<div class="item" data-value="External Audit">External Audit</div>
												<div class="item" data-value="Handle Full Set Auditing">Handle Full Set Auditing Process</div>
												<div class="item" data-value="Internal Audit">Internal Audit</div>
												<div class="item" data-value="Projected Cash Flow">Projected Cash Flow</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_tech_experience[]" value="{{ $post_tech_experience[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Year of experience</div>
											<div class="menu">
												<div class="item" data-value="1">&lt; 1</div>
												<div class="item" data-value="1-2">1 - 2</div>
												<div class="item" data-value="2-5">2 - 5</div>
												<div class="item" data-value="5">&gt; 5</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Job skill #<span class="number">2</span></label>
										<div class="ui selection dropdown">											
											<input type="hidden" value="{{ $post_tech_skill[1] }}" name="post_tech_skill[]">
											<i class="dropdown icon"></i>
											<div class="default text">Select a job skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Audit Software">Audit Software</div>
												<div class="item" data-value="External Audit">External Audit</div>
												<div class="item" data-value="Handle Full Set Auditing">Handle Full Set Auditing Process</div>
												<div class="item" data-value="Internal Audit">Internal Audit</div>
												<div class="item" data-value="Projected Cash Flow">Projected Cash Flow</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_tech_experience[]" value="{{ $post_tech_experience[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Year of experience</div>
											<div class="menu">
												<div class="item" data-value="1">&lt; 1</div>
												<div class="item" data-value="1-2">1 - 2</div>
												<div class="item" data-value="2-5">2 - 5</div>
												<div class="item" data-value="5">&gt; 5</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Job skill #<span class="number">3</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" value="{{ $post_tech_skill[2] }}" name="post_tech_skill[]">
											<i class="dropdown icon"></i>
											<div class="default text">Select a job skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Audit Software">Audit Software</div>
												<div class="item" data-value="External Audit">External Audit</div>
												<div class="item" data-value="Handle Full Set Auditing">Handle Full Set Auditing Process</div>
												<div class="item" data-value="Internal Audit">Internal Audit</div>
												<div class="item" data-value="Projected Cash Flow">Projected Cash Flow</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_tech_experience[]" value="{{ $post_tech_experience[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Year of experience</div>
											<div class="menu">
												<div class="item" data-value="1">&lt; 1</div>
												<div class="item" data-value="1-2">1 - 2</div>
												<div class="item" data-value="2-5">2 - 5</div>
												<div class="item" data-value="5">&gt; 5</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>
								<?php $post_soft_skill = explode(',',$post->post_soft_skill);?>
								<?php $post_soft_experience = explode(',',$post->post_soft_experience);?>
								<div class="ui repeating group">
									<div class="inline field">
										<label>Soft skill #<span class="number">1</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_skill[]" value="{{ $post_soft_skill[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select a soft skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Analytical">Analytical / research skills</div>
												<div class="item" data-value="Computer literacy">Computer literacy</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_experience[]" value="{{ $post_soft_experience[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Level</div>
											<div class="menu">
												<div class="item" data-value="Beginner">Beginner</div>
												<div class="item" data-value="Intermediate">Intermediate</div>
												<div class="item" data-value="Advanced">Advanced</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Soft skill #<span class="number">2</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_skill[]" value="{{ $post_soft_skill[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a soft skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Analytical">Analytical / research skills</div>
												<div class="item" data-value="Computer literacy">Computer literacy</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_experience[]" value="{{ $post_soft_experience[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Level</div>
											<div class="menu">
												<div class="item" data-value="Beginner">Beginner</div>
												<div class="item" data-value="Intermediate">Intermediate</div>
												<div class="item" data-value="Advanced">Advanced</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Soft skill #<span class="number">3</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_skill[]" value="{{ $post_soft_skill[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a soft skill</div>
											<div class="menu">
												<div class="header">Accounting:&nbsp;Auditing</div>
												<div class="item" data-value="Analytical">Analytical / research skills</div>
												<div class="item" data-value="Computer literacy">Computer literacy</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_soft_experience[]" value="{{ $post_soft_experience[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Level</div>
											<div class="menu">
												<div class="item" data-value="Beginner">Beginner</div>
												<div class="item" data-value="Intermediate">Intermediate</div>
												<div class="item" data-value="Advanced">Advanced</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more skill</a> -->
									</div>
								</div>
								<?php $post_languages = explode(',',$post->post_languages);?>
								<?php $post_languages_spoken = explode(',',$post->post_languages_spoken);?>
								<?php $post_languages_written = explode(',',$post->post_languages_written);?>
								<div class="ui repeating group">
									<div class="inline field">
										<label>Language #<span class="number">1</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages[]" id="post_languages[]" value="{{ $post_languages[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select a language</div>
											<div class="menu">
												<div class="item" data-value="English">English</div>
												<div class="item" data-value="Chinese">Chinese</div>
												<div class="item" data-value="Malay">Malay</div>
												<div class="item" data-value="Tamil">Tamil</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_spoken[]" value="{{ $post_languages_spoken[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select your spoken level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_written[]" value="{{ $post_languages_written[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select your written level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more language</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Language #<span class="number">2</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages[]" id="post_languages[]" value="{{ $post_languages[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a language</div>
											<div class="menu">
												<div class="item" data-value="English">English</div>
												<div class="item" data-value="Chinese">Chinese</div>
												<div class="item" data-value="Malay">Malay</div>
												<div class="item" data-value="Tamil">Tamil</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_spoken[]" value="{{ $post_languages_spoken[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select your spoken level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_written[]" value="{{ $post_languages_written[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select your written level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more language</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Language #<span class="number">3</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages[]" id="post_languages[]" value="{{ $post_languages[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a language</div>
											<div class="menu">
												<div class="item" data-value="English">English</div>
												<div class="item" data-value="Chinese">Chinese</div>
												<div class="item" data-value="Malay">Malay</div>
												<div class="item" data-value="Tamil">Tamil</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_spoken[]" value="{{ $post_languages_spoken[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select your spoken level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_languages_written[]" value="{{ $post_languages_written[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select your written level</div>
											<div class="menu">
												<div class="item" data-value="Fair">Fair</div>
												<div class="item" data-value="Good">Good</div>
												<div class="item" data-value="Excellent">Excellent</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more language</a> -->
									</div>
								</div>
								<?php $post_education = explode(',',$post->post_education);?>
								<?php $post_course = explode(',',$post->post_course);?>
								<div class="ui repeating group">
									<div class="inline field">
										<label>Education level #<span class="number">1</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_education[]" value="{{ $post_education[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select an education level</div>
											<div class="menu">
												<div class="item" data-value="Secondary school">Secondary school</div>
												<div class="item" data-value="Pre-U">Pre-U</div>
												<div class="item" data-value="Diploma">Diploma</div>
												<div class="item" data-value="Advanced Diploma">Advanced Diploma</div>
												<div class="item" data-value="Degree">Degree</div>
											</div>
										</div>
										in
										<div class="ui selection dropdown">
											<input type="hidden" name="post_course[]" value="{{ $post_course[0] }}" data-validation="required">
											<i class="dropdown icon"></i>
											<div class="default text">Select a course</div>
											<div class="menu">
												<div class="header">Agriculture</div>
												<div class="item" data-value="Agriculture">Agriculture</div>
												<div class="item" data-value="Aquaculture">Aquaculture</div>
												<div class="item" data-value="Forestry">Forestry</div>
												<div class="header">Arts</div>
												<div class="item" data-value="Fine arts">Fine arts</div>
												<div class="item" data-value="Music">Music</div>
												<div class="item" data-value="Performing arts">Performing arts</div>
												<div class="header">Business</div>
												<div class="item" data-value="Accounting">Accounting</div>
												<div class="item" data-value="Business administration">Business administration</div>
												<div class="item" data-value="Finance">Finance</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more education</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Education level #<span class="number">2</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_education[]" value="{{ $post_education[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select an education level</div>
											<div class="menu">
												<div class="item" data-value="Secondary school">Secondary school</div>
												<div class="item" data-value="Pre-U">Pre-U</div>
												<div class="item" data-value="Diploma">Diploma</div>
												<div class="item" data-value="Advanced Diploma">Advanced Diploma</div>
												<div class="item" data-value="Degree">Degree</div>
											</div>
										</div>
										in
										<div class="ui selection dropdown">
											<input type="hidden" name="post_course[]" value="{{ $post_course[1] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a course</div>
											<div class="menu">
												<div class="header">Agriculture</div>
												<div class="item" data-value="Agriculture">Agriculture</div>
												<div class="item" data-value="Aquaculture">Aquaculture</div>
												<div class="item" data-value="Forestry">Forestry</div>
												<div class="header">Arts</div>
												<div class="item" data-value="Fine arts">Fine arts</div>
												<div class="item" data-value="Music">Music</div>
												<div class="item" data-value="Performing arts">Performing arts</div>
												<div class="header">Business</div>
												<div class="item" data-value="Accounting">Accounting</div>
												<div class="item" data-value="Business administration">Business administration</div>
												<div class="item" data-value="Finance">Finance</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more education</a> -->
									</div>
								</div>
								
								<div class="ui repeating group">
									<div class="inline field">
										<label>Education level #<span class="number">3</span></label>
										<div class="ui selection dropdown">
											<input type="hidden" name="post_education[]" value="{{ $post_education[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select an education level</div>
											<div class="menu">
												<div class="item" data-value="Secondary school">Secondary school</div>
												<div class="item" data-value="Pre-U">Pre-U</div>
												<div class="item" data-value="Diploma">Diploma</div>
												<div class="item" data-value="Advanced Diploma">Advanced Diploma</div>
												<div class="item" data-value="Degree">Degree</div>
											</div>
										</div>
										in
										<div class="ui selection dropdown">
											<input type="hidden" name="post_course[]" value="{{ $post_course[2] }}">
											<i class="dropdown icon"></i>
											<div class="default text">Select a course</div>
											<div class="menu">
												<div class="header">Agriculture</div>
												<div class="item" data-value="Agriculture">Agriculture</div>
												<div class="item" data-value="Aquaculture">Aquaculture</div>
												<div class="item" data-value="Forestry">Forestry</div>
												<div class="header">Arts</div>
												<div class="item" data-value="Fine arts">Fine arts</div>
												<div class="item" data-value="Music">Music</div>
												<div class="item" data-value="Performing arts">Performing arts</div>
												<div class="header">Business</div>
												<div class="item" data-value="Accounting">Accounting</div>
												<div class="item" data-value="Business administration">Business administration</div>
												<div class="item" data-value="Finance">Finance</div>
											</div>
										</div>
										<!-- <a href class="text red"><i class="remove icon"></i></a> -->
									</div>
									<div class="action">
										<!-- <a href=""><i class="plus icon"></i> Add more education</a> -->
									</div>
								</div>
								
								<div class="ui divider"></div>
								
								<div class="inline field">
									<label>* Salary offerred</label>
									<div class="ui selection dropdown">
										<input type="hidden" name="post_salry" data-validation="required" value="{{ $post->post_salry }}">
										<i class="dropdown icon"></i>
										<div class="default text">Select a salary range</div>
										<div class="menu">
											<div class="item" data-value="0-1000">&lt; RM1,000</div>
											<div class="item" data-value="1001-2000">RM1,001 - RM2,000</div>
											<div class="item" data-value="2001-3500">RM2,001 - RM3,500</div>
											<div class="item" data-value="3501-5000">RM3,501 - RM5,000</div>
											<div class="item" data-value="5001-8000">RM5,001 - RM8,000</div>
											<div class="item" data-value="8001-12000">RM8,001 - RM12,000</div>
											<div class="item" data-value="12001-15000">RM12,001 - RM15,000</div>
											<div class="item" data-value="15001-">&gt; RM15,001</div>
										</div>
									</div>
								</div>
								
								<!--<div class="inline field">
									<label>* Department</label>
									<div class="ui selection dropdown">
										<input type="hidden" name="post_department" id="post_department" value="{{ $post->post_department }}">
										<i class="dropdown icon"></i>
										<div class="default text">Select a department for this post</div>
										<div class="menu">
											<div class="item" data-value="Default">Default</div>
											<div class="item" data-value="HR">HR</div>
											<div class="item" data-value="Finance">Finance</div>
										</div>
									</div>
								</div>-->
								
								<div class="inline field">
									<label>Email alert</label>
									<input type="text" size="50" placeholder="Separate the email address by comma." name="post_email_alert" value="{{ $post->post_email_alert }}" />
								</div>
								
								<!-- <div class="inline field">
									<label>* Plan</label>
									<div class="ui selection dropdown">
										<input type="hidden" name="languages">
										<i class="dropdown icon"></i>
										<div class="default text">Select a plan</div>
										<div class="menu">
											<div class="item" data-value="1">Use 1 credit (9 credits left)</div>
											<div class="item" data-value="2">Use unlimited plan</div>
										</div>
									</div>
								</div> -->
								
									
								<div class="action">
									<button type="submit" id="btn-submit" class="ui green submit button" name="btn_submit"><i class="save icon"></i> Update</button>
									<a href="{{ url('employer/post/list') }}" class="ui default button">Back</a>
									<!-- <button type="reset" id="btn-reset" class="ui primary button"><i class="search icon"></i> Preview</button> -->
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function (e) {
      $('#employer_post')
       .form({
         fields: {
         post_title   : 'empty',
         post_type	  : 'empty',
         post_desc	  : 'empty',
         post_category  : 'empty',
         post_level: 'empty',
         post_position: 'empty',
         post_country: 'empty',
         post_state  : 'empty',
         post_city  : 'empty',
         post_address  : 'empty',
         post_postalcode  : 'empty',
         post_tech_skill  : 'empty',
         post_tech_experience  : 'empty',
         post_soft_skill  : 'empty',
         post_soft_experience  : 'empty',
         post_languages  : 'empty',
         post_languages_written  : 'empty',
         post_languages_spoken  : 'empty',
         post_education  : 'empty',
         post_course  : 'empty',
         post_salry  : 'empty',
         post_department  : 'empty',
         post_email_alert  : 'empty'

         }
       });
    });
</script>
<script>
function initMap() {
	var mapContainer = $("#map");
	var myLatLng = {lat: 3.134047, lng: 101.679090};

	if ( $("#lat").val() && $("#long").val() ) {
		myLatLng = {
			lat: parseFloat($("#lat").val()),
			lng: parseFloat($("#long").val())
		};
	}
	
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: myLatLng
	});
	
	var geocoder = new google.maps.Geocoder();
	var marker;

	if ( $("#lat").val() && $("#long").val() ) {
		marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'Hello World!'
		});
	}
	
	google.maps.event.addListener(map, 'click', function(event) {
		if ( marker ) {
			marker.setPosition(event.latLng);
		} else {
			marker = new google.maps.Marker({
		        position: event.latLng,
		        map: map
		    });
		}

		$("#lat").val(event.latLng.lat());
		$("#long").val(event.latLng.lng());
		
		geocoder.geocode({
			'latLng': event.latLng
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					var fullAddress = results[0].formatted_address;
					$("#address").val(fullAddress);
				}
			}
		});
	});
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFcfsp5EDchadYiYGxjOCfC6CV-P0-4g&callback=initMap"></script>
@endsection
