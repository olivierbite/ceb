<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 bs-sidebar">
<h4>{{ trans('report.contracts_reports') }}</h4>  
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.savings_contract') }}
  		</a>
  	</li>
   <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/loan" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.ordinary_loan_contract') }}
  		</a>
   </li>
   <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/loan" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.special_loan_contract') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/loan" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_regularisation_contract') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/loan" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.social_loan_contract') }}
  		</a>
  </li>
</ul>
</div> 
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<h4>{{ trans('report.files_reports') }}</h4>   
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contributions" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.savings_file') }}
  		</a>
  </li>
  <li>
  		<a  href="{{ route('reports.date.filter') }}/?reporturl=reports/members/loanrecords" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loans_file') }}
  		</a>
  </li>
</ul>
</div> 
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
<h4>{{ trans('report.the_disbursed_parts') }}</h4>
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/accounting_dp" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.accounting_dp') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/saving_dp" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.saving_dp') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/loan_dp" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_dp') }}
  		</a>
  </li>
</ul>   
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
<h4>{{ trans('report.the_accountants_reports') }}</h4>  
<ul class="nav nav-list">
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/ledger" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.ledger') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/bilan" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.Bilan') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/journal" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.journal') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/accounting/ledger" class="popdown">
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
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.cautions') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.savings_contribution') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.loan_repayment') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.members') }}
  		</a>
  </li>
  <li>
  		<a href="{{ route('reports.date.filter') }}/?reporturl=reports/members/contracts/saving" class="popdown">
  			<i class="icon-chevron-right"></i> {{ trans('report.various_withdrawal') }}
  		</a>
  </li>
</ul>
</div>  