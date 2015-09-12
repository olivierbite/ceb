<div class="box-header with-border pull-left">
    <h3 class="box-title">
              {{ trans('member.member_attornes') }}

   <a data-toggle="modal" class="btn btn-primary pull-right" href="{{ route('attornies.create') }}?member={!! isset($member->id)?$member->id:null !!}" data-target="#myModal"> <i class="fa fa-plus"></i> 
</a>
</h3>
</div>
 @each ('attornies.item', $member->attornies, 'attorney', 'members.no-items')
     <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->