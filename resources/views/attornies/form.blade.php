<link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{Url()}}/assets/dist/css/modalPopup.css" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-8 col-md-8 ModalPopup"> 
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
            <a href="#" class="close-popdown">close</a>
                <div class="panel-heading display-table" >
                    <div class="row display-tr" style="text-align: center;font-weight: 700;" >
                        <h3 class="panel-title display-td" >{{ trans('member.transactions_and_other_withdrawals_on_savings') }}</h3>
                        </div>
                      </div>
                </div>

<div class="row">
  <div class="col-xs-4 col-md-4">
      <div class="form-group">
 <label>{{ trans('attornies.names') }}</label>
  {!! Form::input('text', 'names', null, ['class'=>'form-control']) !!}
</div>
</div>

  <div class="col-xs-4 col-md-4">
      <div class="form-group">
 <label>{{ trans('general.upload_photo') }}</label>
 <input type="file" name="photo" id="upload-photo" accept="image/*">
 </div>
 </div>

    <div class="col-xs-4 col-md-4">
        <div class="form-group">
 <label>{{ trans('general.signature_selected') }}</label>

 <input type="file" name="signature" id="upload-signature" accept="image/*">
</div>
</div>
</div>
<div class="row">
    <div class="col-xs-12">
        <button class="btn btn-success btn-lg btn-block" type="submit">{{ trans('general.save') }}</button>
    </div>
</div>