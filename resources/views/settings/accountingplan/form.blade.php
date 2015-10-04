<link href="{{Url()}}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{Url()}}/assets/dist/css/modalPopup.css" rel="stylesheet" type="text/css" />
<div class="container">
<div class="row ModalPopup">
  <!-- You can make it whatever width you want. I'm making it full width
       on <= small devices and 4/12 page width on >= medium devices -->
  <div class="col-xs-8 col-md-8 ModalPopup">
   {!! Form::open(['url'=>route('settings.accountingplan.store')]) !!}
          <div class="row">
              <div class="col-xs-6 col-md-6">
                  <div class="form-group">
                      <label for="entitled">
                    	 {{ trans('account.entitled') }}
                       </label>
                     	 	 {!! Form::input('text', 'entitled', null, ['class'=>'form-control','placeholder'=>trans('general.write_your_wording')]) !!}
                  </div>
              </div>
             <div class="col-xs-6 col-md-6">
                  <div class="form-group">
                      <label for="accounting_nature">
                    	 {{ trans('account.accounting_nature') }}
                       </label>
                     	 {!! Form::select('acccount_nature', $accountNatures, null, ['class'=>'form-control']) !!}
                  </div>
              </div>
          </div>
          <div class="row">
           @include('accounting.form')
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <button class="btn btn-success btn-lg btn-block submit-member-transaction-button" type="submit">{{ trans('general.save') }}</button>
              </div>
          </div>
    {!! Form::close() !!}
  </div>
</div>            
</div>    