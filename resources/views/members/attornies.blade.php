<div class="box-header with-border">
    <h3 class="box-title">
              {{ trans('member.member_attornes') }}
</h3>
              <div class="box-tools pull-right">
 </div>
            </div>
     <!-- Button trigger modal -->
<a data-toggle="modal" class="btn btn-primary" href="{{ route('home') }}" data-target="#myModal"> <i class="fa fa-plus"></i> {{ trans('member.add_new_attorney') }}
</a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->