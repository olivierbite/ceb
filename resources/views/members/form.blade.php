     <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
          <div class="panel panel-info">

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-lg-5 ">

                  <div class="img-circle" alt="member Image" align="center">
                  <div class="track-info-art">
                      <div class="button-normal upload-btn" id="upload-photo-btn">
                      <div>
                              @include('files.show',['filename'=>$member->photo])
                              </div>

                          <span id="cover-photo" class="upload-btn-text">
                             {{ trans('general.upload_photo') }}
                          </span>
                          <span id="cover-photo-sel" class="upload-btn-text" style="display: none;color:green;font-weight:bold;">
                          {{ trans('general.photo_selected') }}
                          </span>
                          <input type="file" name="photo" id="upload-photo" accept="image/*">
                          </div>
                      </div>
                  </div>

             <div class="col-xs-12 col-sm-12 "> <br>
                  <dl>
                    <dt>{{ trans('member.adhersion_number') }} <em style="font-size:12px;font-weight:100"></em>
                      {!! $errors->first('registration_number','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('registration_number')) ? 'has-error' : '' }}">
                     {!! Form::text('registration_number', $member->adhersion_id, ['class'=>'form-control','placeholder'=>trans('member.adhersion_number'),'disabled']) !!}
                  </dd>
                    <dt>{{ trans('member.district') }} <em style="font-size:12px;font-weight:100">(Kicukiro, Nyarugenge...)</em>
                      {!! $errors->first('district','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('district')) ? 'has-error' : '' }}">
                     {!! Form::text('district', $member->district, ['class'=>'form-control','placeholder'=>trans('member.district')]) !!}
                  </dd>
                    <dt>{{ trans('member.province') }}
                     {!! $errors->first('province','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('province')) ? 'has-error' : '' }}">
                       {!! Form::text('province', $member->province, ['class'=>'form-control','placeholder'=>trans('member.province')]) !!}
                    </dd>
                    <dt>{{ trans('member.institution') }}
                     {!! $errors->first('institution','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('institution')) ? 'has-error' : '' }}">
                       {!! Form::text('institution', $member->institution, ['class'=>'form-control','placeholder'=>trans('member.institution')]) !!}
                    </dd>
                    <dt>{{ trans('member.service') }}
                     {!! $errors->first('service','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('service')) ? 'has-error' : '' }}">
                        {!! Form::text('service', $member->service, ['class'=>'form-control','placeholder'=>trans('member.service') ]) !!}
                    </dd>
                    <dt>{{ trans('member.monthly_fee') }}:
                         {!! $errors->first('monthly_fee','<em class="has-error">(:message)</em>') !!}
                     </dt>
                    <dd  class=" {{ ($errors->has('monthly_fee')) ? 'has-error' : '' }}">

                          {!! Form::text('monthly_fee', $member->monthly_fee, ['class'=>'form-control','placeholder'=> trans('member.monthly_fee')]) !!}
                       </dd>

                   <dt>{{ trans('member.termination_date') }}
                     {!! $errors->first('termination_date','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('termination_date')) ? 'has-error' : '' }}">
                        {!! Form::text('termination_date', $member->termination_date, ['class'=>'form-control',
                        'id'=>'date','placeholder'=>trans('member.termination_date') ]) !!}
                    </dd>
                  </dl>
                </div>

                </div>


                <div class=" col-md-7 col-lg-7 ">
                 <div class="img-circle" alt="member Image" align="center" style="margin-bottom:210px;">
                  <div class="track-info-art" >
                      <div class="button-normal upload-btn" id="upload-signature-btn">
                       <div>
                            @include('files.show',['filename'=>$member->signature])
                         </div>
                          <span id="cover-signature" class="upload-btn-text">
                            {{ trans('general.upload_signature') }}
                          </span>
                          <span id="cover-signature-sel" class="upload-btn-text" style="display: none;color:green;font-weight:bold;">{{ trans('general.signature_selected') }}</span>
                          <input type="file" name="signature" id="upload-signature" accept="image/*">
                          </div>
                      </div>
                  </div>
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th style="border-top: none;">{{ trans('member.names') }}:
                          {!! $errors->first('names','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('names')) ? 'has-error' : '' }}" style="border-top: none;">
                          {!! Form::text('names', $member->first_name.' '.$member->last_name, ['class'=>'form-control','placeholder'=>trans('member.names') ]) !!}
                           </td>
                      </tr>

                      <tr>
                        <th>{{ trans('member.date_of_birth') }}:
                        {!! $errors->first('date_of_birth','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('date_of_birth')) ? 'has-error' : '' }}">
                          {!! Form::text('date_of_birth',date('Y-m-d',strtotime($member->date_of_birth)),['class'=>'form-control','id'=>'date2','data-inputmask'=>'\'alias\':\'dd-mm-yyyy\'']) !!}</td>
                      </tr>
                      <tr>
                        <tr>
                        <th>{{ trans('member.sex') }}:
                      {!! $errors->first('sex','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('sex')) ? 'has-error' : '' }}">
                           {!! Form::select('sex',['Male'=>'Male','Female'=>'Female'],$member->sex, ['class' => 'form-control']) !!}
                        </td>
                      </tr>

                       <tr>
                        <th>{{ trans('member.nid') }}:
                        {!! $errors->first('member_nid','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('member_nid')) ? 'has-error' : '' }}">
                        {!! Form::text('member_nid', $member->member_nid, ['class'=>'form-control','placeholder'=> trans('member.nid') ]) !!}
                        </td>
                      </tr>
                        <tr>
                        <th>{{ trans('member.nationality') }}:
                          {!! $errors->first('nationality','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('nationality')) ? 'has-error' : '' }}">
                          {!! Form::text('nationality', $member->nationality, ['class'=>'form-control','placeholder'=>trans('member.nationality')]) !!}</td>
                      </tr>
                      <tr>
                        <th>{{ trans('member.email') }}:
                         {!! $errors->first('email','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('email')) ? 'has-error' : '' }}">
                           {!! Form::input('email','email', $member->email, ['class'=>'form-control email','placeholder'=>trans('member.email')]) !!}
                        </td>
                      </tr>
                      <tr>
                        <th> {{ trans('member.telephone') }}:
                         {!! $errors->first('telephone','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('telephone')) ? 'has-error' : '' }}">

                          {!! Form::text('telephone', $member->telephone, ['class'=>'form-control','placeholder'=> trans('member.telephone')]) !!}
                        </td>
                      </tr>

                    </tbody>
                  </table>

                  <a href="{!!route('members.index')!!}" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</a>
                  <button href="#" class="btn btn-success"><i class="fa fa-floppy-o"></i> {!! $button !!}</button>

                </div>
              </div>
            </div>
    </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
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
</div>


    <script src="{{Url()}}/assets/dist/js/datepickr.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/date.js" type="text/javascript"></script>