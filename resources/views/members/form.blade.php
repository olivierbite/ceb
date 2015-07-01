<div class="inline  fields">
    <div class="required field" >
    <div class="field" >
      <label class="fix wide column">{!! trans('customer.email') !!}</label>
      <input type="text" name="email" value="{!! $customer->email !!}">
    </div>

    <div class="field" >
      <label class="fix wide column">{!! trans('customer.description') !!}</label>
      <input type="text" name="description" value="{!! $customer->description !!}">
    </div>

<div class="field">
  <button type="submit" class="ui bottom attached green button" style="width:100%">{!! trans('customer.add_customer') !!}</button>
</div>
</div>