<div class="left">
      <div class="ui image caption" data-position="bottom">
        <img src="{{$profile_pic}}" alt=""  id="jobsekker_profile_image" />
        <form name="photo" id="jobseeker_profile_action" enctype="multipart/form-data" action="{{route('jobsekker.update.profilepic')}}" method="post">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <input type="file" id="ImageBrowse" name="signFile" style="display:none" accept="image/*">
            <input type="submit" name="jobseeker_profile_upload" value="Upload" style="display: none;" />
        </form>
        <a class="caption" href="javascript:void(0);" id="OpenImgUpload" onclick='$("#ImageBrowse").click()'><i class="photo icon"></i> Upload photo</a>
    </div>
<?php 
$routeName = Route::currentRouteName();
$currUrl = url()->current(); 
$profile = route('jobsekker.profile');
$employment = route('jobsekker.employment');
$education = route('jobsekker.education');
$preferences = route('jobsekker.preferences');
$reference = route('jobsekker.reference');
$otherinfo = route('jobsekker.otherinfo');
$settings = route('jobsekker.settings');
$skill = route('jobsekker.skill');
$language = route('jobsekker.language');
?>
	<div class="ui vertical menu">
              <a href="{{route('jobsekker.profile')}}" class="{{($currUrl==$profile) ? 'active' : '' }} item">
                Personal info
              </a>
              <a href="{{route('jobsekker.employment')}}" class="{{($currUrl==$employment || $routeName=='employment_edit') ? 'active' : '' }} item">
                Employments
              </a>
              <a href="{{route('jobsekker.education')}}" class="{{($currUrl==$education || $routeName=='education_edit') ? 'active' : '' }} item">
                Educations
              </a>
              <a href="{{route('jobsekker.skill')}}" class="{{($currUrl==$skill || $routeName=='skilladd') ? 'active' : '' }} item">
                Skills
              </a>
              <a href="{{route('jobsekker.language')}}" class="{{($currUrl==$language || $routeName=='languageadd') ? 'active' : '' }} item">
                Languages
              </a>
              <a href="{{route('jobsekker.preferences')}}" class="{{($currUrl==$preferences) ? 'active' : '' }} item">
                Preferences
              </a>
              <a href="{{ url('jobseeker/resumes') }}" class="item">
                Resumes
              </a>
              <a href="{{route('jobsekker.reference')}}" class="{{($currUrl==$reference || $routeName=='reference_edit') ? 'active' : '' }} item">
                References
              </a>
              <a href="{{route('jobsekker.otherinfo')}}" class="{{($currUrl==$otherinfo) ? 'active' : '' }} item">
                Other info
              </a>
              <a href="{{route('jobsekker.settings')}}" class="{{($currUrl==$settings) ? 'active' : '' }} item">
                Settings
              </a>
            </div>
</div>
