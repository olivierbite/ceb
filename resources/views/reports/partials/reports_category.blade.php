<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bs-sidebar">
<h4>{{ trans('report.contracts_reports') }}</h4>  
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/saving&member_search=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.savings_contract') }}
  		</a>
  	</li>
   <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/loan&member_search=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.ordinary_loan_contract') }}
  		</a>
   </li>
   <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/loan&member_search=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.special_loan_contract') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/loan&member_search=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_regularisation_contract') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/loan&member_search=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.social_loan_contract') }}
  		</a>
  </li>
</ul>
</div> 
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<h4>{{ trans('report.files_reports') }}</h4>   
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contributions&member_search=true&show_dates=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.savings_file') }}
  		</a>
  </li>
  <li>
  		<a  href="{{ route('reports.filter') }}/?reporturl=reports/members/loanrecords&member_search=true&show_dates=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loans_file') }}
  		</a>
  </li>
    <li>
      <a  href="{{ route('reports.filter') }}/?reporturl=reports/loans&show_loan_status=true&show_dates=true&show_exports=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.loan_by_status') }}
      </a>
  </li>
  <li>
      <a  href="{{ route('reports.filter') }}/?reporturl=reports/refunds/monthly&show_exports=true&show_institution=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.monthly_refund_file') }}
      </a>
  </li>

</ul>
</div> 
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<h4>{{ trans('report.the_disbursed_parts') }}</h4>
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/piece/disbursed/account&show_accounts=true&show_dates=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.accounting_piece_disbursed') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/piece/disbursed/saving&show_transaction_input=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.saving_piece_disbursed') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/piece/disbursed/loan&show_transaction_input=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_piece_disbursed') }}
  		</a>
  </li>
</ul>   
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<h4>{{ trans('report.the_accountants_reports') }}</h4>  
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/accounting/ledger&show_dates=true&show_exports=true&show_accounts=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.ledger') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/accounting/bilan&show_dates=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.bilan') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/accounting/journal&show_dates=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.journal') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/accounting/ledger&show_dates=true&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.operating_account') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.accounting.accounts') }}" onclick="OpenInNewTab(this.href)">
  			<i class="icon-chevron-right"></i> {{ trans('report.account_list') }}
  		</a>
  </li>
</ul>    
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<h4>{{ trans('report.the_management_reports') }}</h4>   
<ul class="nav nav-list">
 <li>
      <a href="{{ route('reports.filter') }}/?reporturl=reports/savings/level&show_exports=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.savings_contribution') }}
      </a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/contributions/notcontribuing&show_exports=true" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.contribution_irregularities') }}
  		</a>
  </li>
   <li>
      <a href="{{ route('reports.filter') }}/?reporturl= reports/refunds/irreguralities&show_exports=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.refund_irregularities') }}
      </a>
  </li>
   <li>
      <a href="{{ route('reports.filter') }}/?reporturl=reports/cautions/cautioned_me&member_search=true&show_dates=true&show_exports=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.members_who_cautionned_me') }}
      </a>
  </li>
   <li>
      <a href="{{ route('reports.filter') }}/?reporturl=reports/cautions/cautioned_by_me&member_search=true&show_dates=true&show_exports=true" class="popdown">
        <i class="icon-chevron-right"></i> {{ trans('report.members_cautionned_by_me') }}
      </a>
  </li>
  <!--
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_repayment') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.members') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.various_withdrawal') }}
  		</a>
  </li>
  -->
</ul>
</div>  