<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
 <label>{{ trans('attornies.names') }}</label>
 {!! $errors->first('names','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'names', null, ['class'=>'form-control']) !!}
</div>
<div class="img-circle" alt="member Image" align="center">
{!! $errors->first('photo','<label class="has-error">:message</label>') !!} 
<div class="track-info-art">
  <div class="button-normal upload-btn" id="upload-photo-btn">
  <div>
          @include('files.show',['filename'=>NULL])
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

<div class="img-circle" alt="member Image" align="center" style="margin-bottom:210px;">
{!! $errors->first('signature','<label class="has-error">:message</label>') !!} 
<div class="track-info-art" >
<div class="button-normal upload-btn" id="upload-signature-btn">
<div>
    @include('files.show',['filename'=>NULL])
 </div>
  <span id="cover-signature" class="upload-btn-text">
    {{ trans('general.upload_signature') }}
  </span>
  <span id="cover-signature-sel" class="upload-btn-text" style="display: none;color:green;font-weight:bold;">{{ trans('general.signature_selected') }}</span>
  <input type="file" name="signature" id="upload-signature" accept="image/*">
  </div>
</div>
</div>
<button class="btn btn-success"><i class="fa fa-floppy-o"></i> {!! $button !!}</button>

