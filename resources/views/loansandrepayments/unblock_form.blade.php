@extends('layouts.default')

@section('content_title')
  {!! $title !!}
@endsection

@section('content')
{!! Form::open(['route'=>'loan.unblock.store','method'=>'POST']) !!}

{!! Form::hidden('loanid', $loanid) !!}

<div class="row">
<div class="col-md-12">
  <table class="table table-bordered table-striped">
  <thead>
    <th>{{ trans('member.names') }} </th>
    <th>{{ trans('member.institution') }}</th>
    <th>{{ trans('member.adhersion_number') }}</th>
    <th>{{ trans('member.balance_of_loan') }} </th>
    <th>{{ trans('member.right_to_loan') }} </th>
    <th>{{ trans('loan.operation_type') }} </th>
    <th>{{ trans('loan.rate') }}</th>
    <th>{{ trans('loan.number_of_installments') }}</th>
    <th>{{ trans('loan.monthly_installments') }}</th>
    <th>{{ trans('loan.loan_to_repay') }}</th>
    <th>{{ trans('loan.interests') }}</th>
    <th>{{ trans('loan.administration_fees') }}</th>
    <th>{{ trans('loan.net_to_receive') }}</th>
  
  </thead>

  <tbody>
    <tr>
      <td>{{ $member->first_name.' '.$member->last_name }}</td>
      <td>{{ $member->institution->name }} </td>
      <td>{{ $member->adhersion_id }}  </td>
      <td>{{ number_format($member->Loan_balance) }} </td>
      <td>{{ number_format($loan->right_to_loan) }} </td>
      <td>{{ trans('loans.'.$loan->operation_type) }} </td>
      <td>{{ $loan->rate }}</td>
      <td>{{ number_format($loan->tranches_number) }}</td>
      <td>{{ number_format($loan->monthly_fees) }} </td>
      <td>{{ number_format($loan->loan_to_repay) }}</td>
      <td>{{ number_format($loan->interests) }}</td>
      <td>{{ number_format($loan->urgent_loan_interest) }}</td>
      <td>{{ number_format($loan->amount_received) }}</td>
    </tr>
  </tbody>
</table>  
</div>
    <div class="col-md-12">
  <div class="form-group">
   <label>{{ trans('loan.number_of_cheque') }}</label>
  
{!! $errors->first('cheque_number','<label class="has-error">:message</label>') !!} 
  {!! Form::input('text', 'cheque_number',null,['class'=>'form-control','id'=>'cheque_number'])
    !!}
  </div>
  </div>
  <div class="col-md-12">
  <div class="form-group">
   <label>{{ trans('loan.bank') }}</label>
    {!! Form::select('bank_id',$banks,null,['class'=>'form-control loan-select','id'=>'bank']
      )
  !!}
  </div>
  </div>

  @if ($show_caution_form == true)
  
  <div class="col-md-12">
    @include('loansandrepayments.caution_form')
  </div>
  @endif
  <div class="col-md-12">
    <button class="btn btn-success col-md-12"><i class="fa fa-unlock-alt"></i> {{ trans('loan.unblock') }}</button>
  </div>
</div>

{!! Form::close() !!}

@endsection

@section('scripts')

<script type="text/javascript">
   $('.search-cautionneur').click(function(event) {
      // Prevent the default event action 
      event.preventDefault();
      var cautionneur = $(this).parent().find('input');
      
      // Check if this input has at least some data
      if(cautionneur.val() !== ""){
      window.location.href = window.location.protocol+'//'+window.location.host+'/loans/setcautionneur'+'?'+cautionneur.attr('name')+'='+cautionneur.val();   
        return true;
      }
      // If we reach here it means we have nothing to do, just return false
      return false;
      });
</script>
@endsection