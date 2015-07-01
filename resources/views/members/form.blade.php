     <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
          <div class="panel panel-info">

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-lg-5 ">

                  <div class="img-circle" alt="member Image" align="center">

                      <i class="fa fa fa-user" style="font-size:100px;"></i>

                  </div>
             <div class="col-xs-12 col-sm-12 "> <br>
                  <dl>
                    <dt>Registration number <em style="font-size:12px;font-weight:100"></em>
                      {!! $errors->first('registration_number','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('registration_number')) ? 'has-error' : '' }}">
                     {!! Form::text('registration_number', $member->registration_number, ['class'=>'form-control','placeholder'=>'registration number ']) !!}
                  </dd>
                    <dt>Residence <em style="font-size:12px;font-weight:100">(Sector, District...)</em>
                      {!! $errors->first('residence','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('residence')) ? 'has-error' : '' }}">
                     {!! Form::text('residence', $member->residence, ['class'=>'form-control','placeholder'=>'residence ']) !!}
                  </dd>
                    <dt>Occupation
                     {!! $errors->first('occupation','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('occupation')) ? 'has-error' : '' }}">
                       {!! Form::text('occupation', $member->occupation, ['class'=>'form-control','placeholder'=>'Occupation ']) !!}
                    </dd>
                    <dt>Father's name
                     {!! $errors->first('father_name','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('father_name')) ? 'has-error' : '' }}">
                       {!! Form::text('father_name', $member->father_name, ['class'=>'form-control','placeholder'=>'Father\'s names ']) !!}
                    </dd>
                    <dt>Mother's name
                     {!! $errors->first('mother_name','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('mother_name')) ? 'has-error' : '' }}">
                        {!! Form::text('mother_name', $member->mother_name, ['class'=>'form-control','placeholder'=>'Mother\'s names ']) !!}
                    </dd>
                   <dt>Campus
                     {!! $errors->first('Campus','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('Campus')) ? 'has-error' : '' }}">
                        {!! Form::select('campus',['Huye'=>'Huye','Karongi'=>'Karongi'], $member->campus, ['class'=>'form-control','placeholder'=>'Campus']) !!}
                    </dd>
                    <dt>Study mode
                     {!! $errors->first('mode_of_study','<em class="has-error">(:message)</em>') !!}
                    </dt>
                    <dd class=" {{ ($errors->has('mode_of_study')) ? 'has-error' : '' }}">
                       {!! Form::select('mode_of_study',['Full time'=>'Full time','Part time'=>'Part time','Holidays'=>'Holidays'],$member->mode_of_study) !!}
                       {!! Form::select('session',['Day'=>'Day','Evening'=>'Evening','Weekend'=>'Weekend'],$member->session) !!}
                    </dd>
                  </dl>
                </div>

                </div>


                <div class=" col-md-7 col-lg-7 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <th>Names:
                          {!! $errors->first('names','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('names')) ? 'has-error' : '' }}">
                          {!! Form::text('names', $member->names, ['class'=>'form-control','placeholder'=>'Enter member names']) !!}
                           </td>
                      </tr>

                      <tr>
                        <th>Date of Birth:
                        {!! $errors->first('DOB','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('DOB')) ? 'has-error' : '' }}">
                          {!! Form::text('DOB',date('Y-m-d',strtotime($member->DOB)),['class'=>'form-control','id'=>'date','data-inputmask'=>'\'alias\':\'dd-mm-yyyy\'']) !!}</td>
                      </tr>
                      <tr>
                        <tr>
                        <th>Gender:
                      {!! $errors->first('gender','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                           {!! Form::select('gender',['Male'=>'Male','Female'=>'Female'],$member->gender, ['class' => 'form-control']) !!}
                        </td>
                      </tr>
                      <tr>
                        <th>Martial status:
                           {!! $errors->first('martial_status','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('martial_status')) ? 'has-error' : '' }}">
                          {!! Form::select('martial_status',['Single'=>'Single','Married'=>'Married'],$member->martial_status, ['class' => 'form-control']) !!}
                        </td>
                      </tr>
                       <tr>
                        <th>National ID:
                        {!! $errors->first('NID','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('NID')) ? 'has-error' : '' }}">
                        {!! Form::text('NID', $member->NID, ['class'=>'form-control','placeholder'=>'Enter member national ID']) !!}
                        </td>
                      </tr>
                        <tr>
                        <th>Nationality:
                          {!! $errors->first('nationality','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('nationality')) ? 'has-error' : '' }}">
                          {!! Form::text('nationality', $member->nationality, ['class'=>'form-control','placeholder'=>'Nationality ']) !!}</td>
                      </tr>
                      <tr>
                        <th>Email:
                         {!! $errors->first('email','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('email')) ? 'has-error' : '' }}">
                           {!! Form::input('email','email', $member->email, ['class'=>'form-control email','placeholder'=>'Email  address']) !!}
                        </td>
                      </tr>
                      <tr>
                        <th>Phone Number:
                         {!! $errors->first('telephone','<em class="has-error">(:message)</em>') !!}
                        </th>
                        <td class=" {{ ($errors->has('telephone')) ? 'has-error' : '' }}">

                          {!! Form::text('telephone', $member->telephone, ['class'=>'form-control','placeholder'=>'Telephone or Mobile']) !!}
                        </td>
                      </tr>

                    </tbody>
                  </table>

                 @if(isset($member->id))
                     <a href="{!! route('members.modules.show',$member->id) !!}" class="btn btn-success">
                     <i class="fa fa-book"></i> Register modules
                     </a>
                  @endif
                  <a href="{!!route('members.index')!!}" class="btn btn-warning"><i class="fa fa-remove"></i> Cancel</a>
                  <button href="#" class="btn btn-primary"><i class="fa fa-floppy-o"></i> {!! $button !!}</button>

                </div>
              </div>
            </div>
    </div>