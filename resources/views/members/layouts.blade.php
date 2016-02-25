 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
 @include('members.form')

 @if ($member->hasActiveEmergencyLoan)
 	{{-- Only show emergency loan details if the user has it --}}
 <div class="row">
    <?php $emergencyLoan = $member->activeEmergencyLoan; ?>
 	@include('members.emergency',compact('emergencyLoan'))
 </div>
  @endif

</div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" >
<div class="row">
 @include('members.rightButtons')
</div>
<div class="row">
 @include('members.summary')
</div>
</div>

<script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
<script src="{{Url()}}/assets/dist/js/date.js" type="text/javascript"></script>