<?php

			/**
			 * A   functional.
			 *
			 * @return void
			 */
			public function test()
			{
			    $this->visit('/')
			         ->seePageIs('/');
			}

			/**
			 * A notifications functional.
			 *
			 * @return void
			 */
			public function testNotifications()
			{
			    $this->visit('notifications')
			         ->seePageIs('notifications');
			}

			/**
			 * A members search functional.
			 *
			 * @return void
			 */
			public function testMemberssearch()
			{
			    $this->visit('members/search')
			         ->seePageIs('members/search');
			}

			/**
			 * A members {memberId} refund functional.
			 *
			 * @return void
			 */
			public function testMembersmemberIdrefund()
			{
			    $this->visit('members/1/refund')
			         ->seePageIs('members/{memberId}/refund');
			}

			/**
			 * A members {memberId} contribute functional.
			 *
			 * @return void
			 */
			public function testMembersmemberIdcontribute()
			{
			    $this->visit('members/1/contribute')
			         ->seePageIs('members/{memberId}/contribute');
			}

			/**
			 * A members {memberId} transacts functional.
			 *
			 * @return void
			 */
			public function testMembersmemberIdtransacts()
			{
			    $this->visit('members/1/transacts')
			         ->seePageIs('members/{memberId}/transacts');
			}

			/**
			 * A members {memberId} completetransaction functional.
			 *
			 * @return void
			 */
			public function testMembersmemberIdcompletetransaction()
			{
			    $this->visit('members/1/completetransaction')
			         ->seePageIs('members/{memberId}/completetransaction');
			}

			/**
			 * A members {memberId} attornies functional.
			 *
			 * @return void
			 */
			public function testMembersmemberIdattornies()
			{
			    $this->visit('members/1/attornies')
			         ->seePageIs('members/{memberId}/attornies');
			}

			/**
			 * A members loanrecords {memberId} functional.
			 *
			 * @return void
			 */
			public function testMembersloanrecordsmemberId()
			{
			    $this->visit('members/loanrecords/1')
			         ->seePageIs('members/loanrecords/{memberId}');
			}

			/**
			 * A members contributions {memberId} functional.
			 *
			 * @return void
			 */
			public function testMemberscontributionsmemberId()
			{
			    $this->visit('members/contributions/1')
			         ->seePageIs('members/contributions/{memberId}');
			}

			/**
			 * A members cautions {memberid} functional.
			 *
			 * @return void
			 */
			public function testMemberscautionsmemberid()
			{
			    $this->visit('members/cautions/1')
			         ->seePageIs('members/cautions/{memberid}');
			}

			/**
			 * A members cautioned {memberid} functional.
			 *
			 * @return void
			 */
			public function testMemberscautionedmemberid()
			{
			    $this->visit('members/cautioned/1')
			         ->seePageIs('members/cautioned/{memberid}');
			}

			/**
			 * A members functional.
			 *
			 * @return void
			 */
			public function testMembers()
			{
			    $this->visit('members')
			         ->seePageIs('members');
			}

			/**
			 * A members create functional.
			 *
			 * @return void
			 */
			public function testMemberscreate()
			{
			    $this->visit('members/create')
			         ->seePageIs('members/create');
			}

			/**
			 * A members functional.
			 *
			 * @return void
			 */
			public function testMembers()
			{
			    $this->visit('members')
			         ->seePageIs('members');
			}

			/**
			 * A members {members} functional.
			 *
			 * @return void
			 */
			public function testMembersmembers()
			{
			    $this->visit('members/1')
			         ->seePageIs('members/{members}');
			}

			/**
			 * A members {members} edit functional.
			 *
			 * @return void
			 */
			public function testMembersmembersedit()
			{
			    $this->visit('members/1/edit')
			         ->seePageIs('members/{members}/edit');
			}

			/**
			 * A members {members} functional.
			 *
			 * @return void
			 */
			public function testMembersmembers()
			{
			    $this->visit('members/1')
			         ->seePageIs('members/{members}');
			}

			/**
			 * A members {members} functional.
			 *
			 * @return void
			 */
			public function testMembersmembers()
			{
			    $this->visit('members/1')
			         ->seePageIs('members/{members}');
			}

			/**
			 * A members {members} functional.
			 *
			 * @return void
			 */
			public function testMembersmembers()
			{
			    $this->visit('members/1')
			         ->seePageIs('members/{members}');
			}

			/**
			 * A attornies functional.
			 *
			 * @return void
			 */
			public function testAttornies()
			{
			    $this->visit('attornies')
			         ->seePageIs('attornies');
			}

			/**
			 * A attornies create functional.
			 *
			 * @return void
			 */
			public function testAttorniescreate()
			{
			    $this->visit('attornies/create')
			         ->seePageIs('attornies/create');
			}

			/**
			 * A attornies functional.
			 *
			 * @return void
			 */
			public function testAttornies()
			{
			    $this->visit('attornies')
			         ->seePageIs('attornies');
			}

			/**
			 * A attornies {attornies} functional.
			 *
			 * @return void
			 */
			public function testAttorniesattornies()
			{
			    $this->visit('attornies/1')
			         ->seePageIs('attornies/{attornies}');
			}

			/**
			 * A attornies {attornies} edit functional.
			 *
			 * @return void
			 */
			public function testAttorniesattorniesedit()
			{
			    $this->visit('attornies/1/edit')
			         ->seePageIs('attornies/{attornies}/edit');
			}

			/**
			 * A attornies {attornies} functional.
			 *
			 * @return void
			 */
			public function testAttorniesattornies()
			{
			    $this->visit('attornies/1')
			         ->seePageIs('attornies/{attornies}');
			}

			/**
			 * A attornies {attornies} functional.
			 *
			 * @return void
			 */
			public function testAttorniesattornies()
			{
			    $this->visit('attornies/1')
			         ->seePageIs('attornies/{attornies}');
			}

			/**
			 * A attornies {attornies} functional.
			 *
			 * @return void
			 */
			public function testAttorniesattornies()
			{
			    $this->visit('attornies/1')
			         ->seePageIs('attornies/{attornies}');
			}

			/**
			 * A contributions complete functional.
			 *
			 * @return void
			 */
			public function testContributionscomplete()
			{
			    $this->visit('contributions/complete')
			         ->seePageIs('contributions/complete');
			}

			/**
			 * A contributions cancel functional.
			 *
			 * @return void
			 */
			public function testContributionscancel()
			{
			    $this->visit('contributions/cancel')
			         ->seePageIs('contributions/cancel');
			}

			/**
			 * A contributions batch functional.
			 *
			 * @return void
			 */
			public function testContributionsbatch()
			{
			    $this->visit('contributions/batch')
			         ->seePageIs('contributions/batch');
			}

			/**
			 * A contributions {adhersion_id} remove functional.
			 *
			 * @return void
			 */
			public function testContributionsadhersionidremove()
			{
			    $this->visit('contributions/1/remove')
			         ->seePageIs('contributions/{adhersion_id}/remove');
			}

			/**
			 * A contributions samplecsv functional.
			 *
			 * @return void
			 */
			public function testContributionssamplecsv()
			{
			    $this->visit('contributions/samplecsv')
			         ->seePageIs('contributions/samplecsv');
			}

			/**
			 * A contributions functional.
			 *
			 * @return void
			 */
			public function testContributions()
			{
			    $this->visit('contributions')
			         ->seePageIs('contributions');
			}

			/**
			 * A contributions create functional.
			 *
			 * @return void
			 */
			public function testContributionscreate()
			{
			    $this->visit('contributions/create')
			         ->seePageIs('contributions/create');
			}

			/**
			 * A contributions functional.
			 *
			 * @return void
			 */
			public function testContributions()
			{
			    $this->visit('contributions')
			         ->seePageIs('contributions');
			}

			/**
			 * A contributions {contributions} functional.
			 *
			 * @return void
			 */
			public function testContributionscontributions()
			{
			    $this->visit('contributions/1')
			         ->seePageIs('contributions/{contributions}');
			}

			/**
			 * A contributions {contributions} edit functional.
			 *
			 * @return void
			 */
			public function testContributionscontributionsedit()
			{
			    $this->visit('contributions/1/edit')
			         ->seePageIs('contributions/{contributions}/edit');
			}

			/**
			 * A contributions {contributions} functional.
			 *
			 * @return void
			 */
			public function testContributionscontributions()
			{
			    $this->visit('contributions/1')
			         ->seePageIs('contributions/{contributions}');
			}

			/**
			 * A contributions {contributions} functional.
			 *
			 * @return void
			 */
			public function testContributionscontributions()
			{
			    $this->visit('contributions/1')
			         ->seePageIs('contributions/{contributions}');
			}

			/**
			 * A contributions {contributions} functional.
			 *
			 * @return void
			 */
			public function testContributionscontributions()
			{
			    $this->visit('contributions/1')
			         ->seePageIs('contributions/{contributions}');
			}

			/**
			 * A loans {id} functional.
			 *
			 * @return void
			 */
			public function testLoansid()
			{
			    $this->visit('loans/1')
			         ->seePageIs('loans/{id}');
			}

			/**
			 * A loans cancel functional.
			 *
			 * @return void
			 */
			public function testLoanscancel()
			{
			    $this->visit('loans/cancel')
			         ->seePageIs('loans/cancel');
			}

			/**
			 * A loans complete functional.
			 *
			 * @return void
			 */
			public function testLoanscomplete()
			{
			    $this->visit('loans/complete')
			         ->seePageIs('loans/complete');
			}

			/**
			 * A loans complete functional.
			 *
			 * @return void
			 */
			public function testLoanscomplete()
			{
			    $this->visit('loans/complete')
			         ->seePageIs('loans/complete');
			}

			/**
			 * A loans setcautionneur functional.
			 *
			 * @return void
			 */
			public function testLoanssetcautionneur()
			{
			    $this->visit('loans/setcautionneur')
			         ->seePageIs('loans/setcautionneur');
			}

			/**
			 * A loans pending {loanId?} functional.
			 *
			 * @return void
			 */
			public function testLoanspendingloanId()
			{
			    $this->visit('loans/pending/1')
			         ->seePageIs('loans/pending/{loanId?}');
			}

			/**
			 * A loans blocked {loanId?} functional.
			 *
			 * @return void
			 */
			public function testLoansblockedloanId()
			{
			    $this->visit('loans/blocked/1')
			         ->seePageIs('loans/blocked/{loanId?}');
			}

			/**
			 * A loans process {loanId} {status} functional.
			 *
			 * @return void
			 */
			public function testLoansprocessloanIdstatus()
			{
			    $this->visit('loans/process/1/2')
			         ->seePageIs('loans/process/{loanId}/{status}');
			}

			/**
			 * A loans unlblock functional.
			 *
			 * @return void
			 */
			public function testLoansunlblock()
			{
			    $this->visit('loans/unlblock')
			         ->seePageIs('loans/unlblock');
			}

			/**
			 * A loans unblock form {loanId?} functional.
			 *
			 * @return void
			 */
			public function testLoansunblockformloanId()
			{
			    $this->visit('loans/unblock/form/1')
			         ->seePageIs('loans/unblock/form/{loanId?}');
			}

			/**
			 * A loans remove cautionneur {cautionneur} functional.
			 *
			 * @return void
			 */
			public function testLoansremovecautionneurcautionneur()
			{
			    $this->visit('loans/remove/cautionneur/1')
			         ->seePageIs('loans/remove/cautionneur/{cautionneur}');
			}

			/**
			 * A loans functional.
			 *
			 * @return void
			 */
			public function testLoans()
			{
			    $this->visit('loans')
			         ->seePageIs('loans');
			}

			/**
			 * A loans create functional.
			 *
			 * @return void
			 */
			public function testLoanscreate()
			{
			    $this->visit('loans/create')
			         ->seePageIs('loans/create');
			}

			/**
			 * A loans functional.
			 *
			 * @return void
			 */
			public function testLoans()
			{
			    $this->visit('loans')
			         ->seePageIs('loans');
			}

			/**
			 * A loans {loans} functional.
			 *
			 * @return void
			 */
			public function testLoansloans()
			{
			    $this->visit('loans/1')
			         ->seePageIs('loans/{loans}');
			}

			/**
			 * A loans {loans} edit functional.
			 *
			 * @return void
			 */
			public function testLoansloansedit()
			{
			    $this->visit('loans/1/edit')
			         ->seePageIs('loans/{loans}/edit');
			}

			/**
			 * A loans {loans} functional.
			 *
			 * @return void
			 */
			public function testLoansloans()
			{
			    $this->visit('loans/1')
			         ->seePageIs('loans/{loans}');
			}

			/**
			 * A loans {loans} functional.
			 *
			 * @return void
			 */
			public function testLoansloans()
			{
			    $this->visit('loans/1')
			         ->seePageIs('loans/{loans}');
			}

			/**
			 * A loans {loans} functional.
			 *
			 * @return void
			 */
			public function testLoansloans()
			{
			    $this->visit('loans/1')
			         ->seePageIs('loans/{loans}');
			}

			/**
			 * A regularisation functional.
			 *
			 * @return void
			 */
			public function testRegularisation()
			{
			    $this->visit('regularisation')
			         ->seePageIs('regularisation');
			}

			/**
			 * A regularisation {id} functional.
			 *
			 * @return void
			 */
			public function testRegularisationid()
			{
			    $this->visit('regularisation/1')
			         ->seePageIs('regularisation/{id}');
			}

			/**
			 * A regularisation setcautionneur functional.
			 *
			 * @return void
			 */
			public function testRegularisationsetcautionneur()
			{
			    $this->visit('regularisation/setcautionneur')
			         ->seePageIs('regularisation/setcautionneur');
			}

			/**
			 * A regularisation cancel functional.
			 *
			 * @return void
			 */
			public function testRegularisationcancel()
			{
			    $this->visit('regularisation/cancel')
			         ->seePageIs('regularisation/cancel');
			}

			/**
			 * A regularisation complete functional.
			 *
			 * @return void
			 */
			public function testRegularisationcomplete()
			{
			    $this->visit('regularisation/complete')
			         ->seePageIs('regularisation/complete');
			}

			/**
			 * A regularisation remove cautionneur {cautionneur} functional.
			 *
			 * @return void
			 */
			public function testRegularisationremovecautionneurcautionneur()
			{
			    $this->visit('regularisation/remove/cautionneur/1')
			         ->seePageIs('regularisation/remove/cautionneur/{cautionneur}');
			}

			/**
			 * A refunds complete functional.
			 *
			 * @return void
			 */
			public function testRefundscomplete()
			{
			    $this->visit('refunds/complete')
			         ->seePageIs('refunds/complete');
			}

			/**
			 * A refunds cancel functional.
			 *
			 * @return void
			 */
			public function testRefundscancel()
			{
			    $this->visit('refunds/cancel')
			         ->seePageIs('refunds/cancel');
			}

			/**
			 * A refunds {adhersion_id} remove functional.
			 *
			 * @return void
			 */
			public function testRefundsadhersionidremove()
			{
			    $this->visit('refunds/1/remove')
			         ->seePageIs('refunds/{adhersion_id}/remove');
			}

			/**
			 * A refunds functional.
			 *
			 * @return void
			 */
			public function testRefunds()
			{
			    $this->visit('refunds')
			         ->seePageIs('refunds');
			}

			/**
			 * A refunds create functional.
			 *
			 * @return void
			 */
			public function testRefundscreate()
			{
			    $this->visit('refunds/create')
			         ->seePageIs('refunds/create');
			}

			/**
			 * A refunds functional.
			 *
			 * @return void
			 */
			public function testRefunds()
			{
			    $this->visit('refunds')
			         ->seePageIs('refunds');
			}

			/**
			 * A refunds {refunds} functional.
			 *
			 * @return void
			 */
			public function testRefundsrefunds()
			{
			    $this->visit('refunds/1')
			         ->seePageIs('refunds/{refunds}');
			}

			/**
			 * A refunds {refunds} edit functional.
			 *
			 * @return void
			 */
			public function testRefundsrefundsedit()
			{
			    $this->visit('refunds/1/edit')
			         ->seePageIs('refunds/{refunds}/edit');
			}

			/**
			 * A refunds {refunds} functional.
			 *
			 * @return void
			 */
			public function testRefundsrefunds()
			{
			    $this->visit('refunds/1')
			         ->seePageIs('refunds/{refunds}');
			}

			/**
			 * A refunds {refunds} functional.
			 *
			 * @return void
			 */
			public function testRefundsrefunds()
			{
			    $this->visit('refunds/1')
			         ->seePageIs('refunds/{refunds}');
			}

			/**
			 * A refunds {refunds} functional.
			 *
			 * @return void
			 */
			public function testRefundsrefunds()
			{
			    $this->visit('refunds/1')
			         ->seePageIs('refunds/{refunds}');
			}

			/**
			 * A accounting functional.
			 *
			 * @return void
			 */
			public function testAccounting()
			{
			    $this->visit('accounting')
			         ->seePageIs('accounting');
			}

			/**
			 * A accounting create functional.
			 *
			 * @return void
			 */
			public function testAccountingcreate()
			{
			    $this->visit('accounting/create')
			         ->seePageIs('accounting/create');
			}

			/**
			 * A accounting functional.
			 *
			 * @return void
			 */
			public function testAccounting()
			{
			    $this->visit('accounting')
			         ->seePageIs('accounting');
			}

			/**
			 * A accounting {accounting} functional.
			 *
			 * @return void
			 */
			public function testAccountingaccounting()
			{
			    $this->visit('accounting/1')
			         ->seePageIs('accounting/{accounting}');
			}

			/**
			 * A accounting {accounting} edit functional.
			 *
			 * @return void
			 */
			public function testAccountingaccountingedit()
			{
			    $this->visit('accounting/1/edit')
			         ->seePageIs('accounting/{accounting}/edit');
			}

			/**
			 * A accounting {accounting} functional.
			 *
			 * @return void
			 */
			public function testAccountingaccounting()
			{
			    $this->visit('accounting/1')
			         ->seePageIs('accounting/{accounting}');
			}

			/**
			 * A accounting {accounting} functional.
			 *
			 * @return void
			 */
			public function testAccountingaccounting()
			{
			    $this->visit('accounting/1')
			         ->seePageIs('accounting/{accounting}');
			}

			/**
			 * A accounting {accounting} functional.
			 *
			 * @return void
			 */
			public function testAccountingaccounting()
			{
			    $this->visit('accounting/1')
			         ->seePageIs('accounting/{accounting}');
			}

			/**
			 * A reports filter functional.
			 *
			 * @return void
			 */
			public function testReportsfilter()
			{
			    $this->visit('reports/filter')
			         ->seePageIs('reports/filter');
			}

			/**
			 * A reports functional.
			 *
			 * @return void
			 */
			public function testReports()
			{
			    $this->visit('reports')
			         ->seePageIs('reports');
			}

			/**
			 * A reports members contracts saving {memberId} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsmemberscontractssavingmemberIdexportexcel()
			{
			    $this->visit('reports/members/contracts/saving/1/2')
			         ->seePageIs('reports/members/contracts/saving/{memberId}/{export_excel?}');
			}

			/**
			 * A reports members contracts loan {loanId} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsmemberscontractsloanloanIdexportexcel()
			{
			    $this->visit('reports/members/contracts/loan/1/2')
			         ->seePageIs('reports/members/contracts/loan/{loanId}/{export_excel?}');
			}

			/**
			 * A reports members contracts ordinaryloan {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsmemberscontractsordinaryloanexportexcel()
			{
			    $this->visit('reports/members/contracts/ordinaryloan/1')
			         ->seePageIs('reports/members/contracts/ordinaryloan/{export_excel?}');
			}

			/**
			 * A reports members contracts socialloan {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsmemberscontractssocialloanexportexcel()
			{
			    $this->visit('reports/members/contracts/socialloan/1')
			         ->seePageIs('reports/members/contracts/socialloan/{export_excel?}');
			}

			/**
			 * A reports members loanrecords {startDate} {endDate} {export_excel?} {memberId} functional.
			 *
			 * @return void
			 */
			public function testReportsmembersloanrecordsstartDateendDateexportexcelmemberId()
			{
			    $this->visit('reports/members/loanrecords/1/2/3/4')
			         ->seePageIs('reports/members/loanrecords/{startDate}/{endDate}/{export_excel?}/{memberId}');
			}

			/**
			 * A reports members contributions {startDate} {endDate} {export_excel?} {memberId} functional.
			 *
			 * @return void
			 */
			public function testReportsmemberscontributionsstartDateendDateexportexcelmemberId()
			{
			    $this->visit('reports/members/contributions/1/2/3/4')
			         ->seePageIs('reports/members/contributions/{startDate}/{endDate}/{export_excel?}/{memberId}');
			}

			/**
			 * A reports accounting piece {startDate} {endDate} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsaccountingpiecestartDateendDateexportexcel()
			{
			    $this->visit('reports/accounting/piece/1/2/3')
			         ->seePageIs('reports/accounting/piece/{startDate}/{endDate}/{export_excel?}');
			}

			/**
			 * A reports accounting ledger {startDate} {endDate} {accountid} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsaccountingledgerstartDateendDateaccountidexportexcel()
			{
			    $this->visit('reports/accounting/ledger/1/2/3/4')
			         ->seePageIs('reports/accounting/ledger/{startDate}/{endDate}/{accountid}/{export_excel?}');
			}

			/**
			 * A reports accounting bilan {startDate} {endDate} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsaccountingbilanstartDateendDateexportexcel()
			{
			    $this->visit('reports/accounting/bilan/1/2/3')
			         ->seePageIs('reports/accounting/bilan/{startDate}/{endDate}/{export_excel?}');
			}

			/**
			 * A reports accounting journal {startDate} {endDate} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsaccountingjournalstartDateendDateexportexcel()
			{
			    $this->visit('reports/accounting/journal/1/2/3')
			         ->seePageIs('reports/accounting/journal/{startDate}/{endDate}/{export_excel?}');
			}

			/**
			 * A reports accounting accounts {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsaccountingaccountsexportexcel()
			{
			    $this->visit('reports/accounting/accounts/1')
			         ->seePageIs('reports/accounting/accounts/{export_excel?}');
			}

			/**
			 * A reports piece disbursed saving {transactionid} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportspiecedisbursedsavingtransactionidexportexcel()
			{
			    $this->visit('reports/piece/disbursed/saving/1/2')
			         ->seePageIs('reports/piece/disbursed/saving/{transactionid}/{export_excel?}');
			}

			/**
			 * A reports piece disbursed accounting {transactionid}} functional.
			 *
			 * @return void
			 */
			public function testReportspiecedisbursedaccountingtransactionid()
			{
			    $this->visit('reports/piece/disbursed/accounting/1}')
			         ->seePageIs('reports/piece/disbursed/accounting/{transactionid}}');
			}

			/**
			 * A reports piece disbursed account {startDate} {endDate} {account} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportspiecedisbursedaccountstartDateendDateaccountexportexcel()
			{
			    $this->visit('reports/piece/disbursed/account/1/2/3/4')
			         ->seePageIs('reports/piece/disbursed/account/{startDate}/{endDate}/{account}/{export_excel?}');
			}

			/**
			 * A reports piece disbursed loan {transactionid} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportspiecedisbursedloantransactionidexportexcel()
			{
			    $this->visit('reports/piece/disbursed/loan/1/2')
			         ->seePageIs('reports/piece/disbursed/loan/{transactionid}/{export_excel?}');
			}

			/**
			 * A reports piece disbursed refund {transactionid} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportspiecedisbursedrefundtransactionidexportexcel()
			{
			    $this->visit('reports/piece/disbursed/refund/1/2')
			         ->seePageIs('reports/piece/disbursed/refund/{transactionid}/{export_excel?}');
			}

			/**
			 * A reports cautions cautioned_me {startDate} {endDate} {export_excel?} {memberId} functional.
			 *
			 * @return void
			 */
			public function testReportscautionscautionedmestartDateendDateexportexcelmemberId()
			{
			    $this->visit('reports/cautions/cautioned_me/1/2/3/4')
			         ->seePageIs('reports/cautions/cautioned_me/{startDate}/{endDate}/{export_excel?}/{memberId}');
			}

			/**
			 * A reports cautions cautioned_by_me {startDate} {endDate} {export_excel?} {memberId} functional.
			 *
			 * @return void
			 */
			public function testReportscautionscautionedbymestartDateendDateexportexcelmemberId()
			{
			    $this->visit('reports/cautions/cautioned_by_me/1/2/3/4')
			         ->seePageIs('reports/cautions/cautioned_by_me/{startDate}/{endDate}/{export_excel?}/{memberId}');
			}

			/**
			 * A reports loans balance undefined {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsloansbalanceundefinedexportexcel()
			{
			    $this->visit('reports/loans/balance/undefined/1')
			         ->seePageIs('reports/loans/balance/undefined/{export_excel?}');
			}

			/**
			 * A reports loans {startDate} {endDate} {status} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsloansstartDateendDatestatusexportexcel()
			{
			    $this->visit('reports/loans/1/2/3/4')
			         ->seePageIs('reports/loans/{startDate}/{endDate}/{status}/{export_excel?}');
			}

			/**
			 * A reports refunds monthly {institution} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsrefundsmonthlyinstitutionexportexcel()
			{
			    $this->visit('reports/refunds/monthly/1/2')
			         ->seePageIs('reports/refunds/monthly/{institution}/{export_excel?}');
			}

			/**
			 * A reports refunds irreguralities {institution?} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportsrefundsirreguralitiesinstitutionexportexcel()
			{
			    $this->visit('reports/refunds/irreguralities/1/2')
			         ->seePageIs('reports/refunds/irreguralities/{institution?}/{export_excel?}');
			}

			/**
			 * A reports savings level {institution?} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportssavingslevelinstitutionexportexcel()
			{
			    $this->visit('reports/savings/level/1/2')
			         ->seePageIs('reports/savings/level/{institution?}/{export_excel?}');
			}

			/**
			 * A reports contributions notcontribuing {institution?} {export_excel?} functional.
			 *
			 * @return void
			 */
			public function testReportscontributionsnotcontribuinginstitutionexportexcel()
			{
			    $this->visit('reports/contributions/notcontribuing/1/2')
			         ->seePageIs('reports/contributions/notcontribuing/{institution?}/{export_excel?}');
			}

			/**
			 * A leaves request functional.
			 *
			 * @return void
			 */
			public function testLeavesrequest()
			{
			    $this->visit('leaves/request')
			         ->seePageIs('leaves/request');
			}

			/**
			 * A leaves show functional.
			 *
			 * @return void
			 */
			public function testLeavesshow()
			{
			    $this->visit('leaves/show')
			         ->seePageIs('leaves/show');
			}

			/**
			 * A leaves pending functional.
			 *
			 * @return void
			 */
			public function testLeavespending()
			{
			    $this->visit('leaves/pending')
			         ->seePageIs('leaves/pending');
			}

			/**
			 * A leaves approve {leave} functional.
			 *
			 * @return void
			 */
			public function testLeavesapproveleave()
			{
			    $this->visit('leaves/approve/1')
			         ->seePageIs('leaves/approve/{leave}');
			}

			/**
			 * A leaves reject {leave} functional.
			 *
			 * @return void
			 */
			public function testLeavesrejectleave()
			{
			    $this->visit('leaves/reject/1')
			         ->seePageIs('leaves/reject/{leave}');
			}

			/**
			 * A leaves status {leave} functional.
			 *
			 * @return void
			 */
			public function testLeavesstatusleave()
			{
			    $this->visit('leaves/status/1')
			         ->seePageIs('leaves/status/{leave}');
			}

			/**
			 * A leaves functional.
			 *
			 * @return void
			 */
			public function testLeaves()
			{
			    $this->visit('leaves')
			         ->seePageIs('leaves');
			}

			/**
			 * A leaves create functional.
			 *
			 * @return void
			 */
			public function testLeavescreate()
			{
			    $this->visit('leaves/create')
			         ->seePageIs('leaves/create');
			}

			/**
			 * A leaves functional.
			 *
			 * @return void
			 */
			public function testLeaves()
			{
			    $this->visit('leaves')
			         ->seePageIs('leaves');
			}

			/**
			 * A settings institution functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitution()
			{
			    $this->visit('settings/institution')
			         ->seePageIs('settings/institution');
			}

			/**
			 * A settings institution create functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioncreate()
			{
			    $this->visit('settings/institution/create')
			         ->seePageIs('settings/institution/create');
			}

			/**
			 * A settings institution functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitution()
			{
			    $this->visit('settings/institution')
			         ->seePageIs('settings/institution');
			}

			/**
			 * A settings institution {institution} functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioninstitution()
			{
			    $this->visit('settings/institution/1')
			         ->seePageIs('settings/institution/{institution}');
			}

			/**
			 * A settings institution {institution} edit functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioninstitutionedit()
			{
			    $this->visit('settings/institution/1/edit')
			         ->seePageIs('settings/institution/{institution}/edit');
			}

			/**
			 * A settings institution {institution} functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioninstitution()
			{
			    $this->visit('settings/institution/1')
			         ->seePageIs('settings/institution/{institution}');
			}

			/**
			 * A settings institution {institution} functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioninstitution()
			{
			    $this->visit('settings/institution/1')
			         ->seePageIs('settings/institution/{institution}');
			}

			/**
			 * A settings institution {institution} functional.
			 *
			 * @return void
			 */
			public function testSettingsinstitutioninstitution()
			{
			    $this->visit('settings/institution/1')
			         ->seePageIs('settings/institution/{institution}');
			}

			/**
			 * A settings accountingplan functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplan()
			{
			    $this->visit('settings/accountingplan')
			         ->seePageIs('settings/accountingplan');
			}

			/**
			 * A settings accountingplan create functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplancreate()
			{
			    $this->visit('settings/accountingplan/create')
			         ->seePageIs('settings/accountingplan/create');
			}

			/**
			 * A settings accountingplan functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplan()
			{
			    $this->visit('settings/accountingplan')
			         ->seePageIs('settings/accountingplan');
			}

			/**
			 * A settings accountingplan {accountingplan} functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplanaccountingplan()
			{
			    $this->visit('settings/accountingplan/1')
			         ->seePageIs('settings/accountingplan/{accountingplan}');
			}

			/**
			 * A settings accountingplan {accountingplan} edit functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplanaccountingplanedit()
			{
			    $this->visit('settings/accountingplan/1/edit')
			         ->seePageIs('settings/accountingplan/{accountingplan}/edit');
			}

			/**
			 * A settings accountingplan {accountingplan} functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplanaccountingplan()
			{
			    $this->visit('settings/accountingplan/1')
			         ->seePageIs('settings/accountingplan/{accountingplan}');
			}

			/**
			 * A settings accountingplan {accountingplan} functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplanaccountingplan()
			{
			    $this->visit('settings/accountingplan/1')
			         ->seePageIs('settings/accountingplan/{accountingplan}');
			}

			/**
			 * A settings accountingplan {accountingplan} functional.
			 *
			 * @return void
			 */
			public function testSettingsaccountingplanaccountingplan()
			{
			    $this->visit('settings/accountingplan/1')
			         ->seePageIs('settings/accountingplan/{accountingplan}');
			}

			/**
			 * A ajax loans functional.
			 *
			 * @return void
			 */
			public function testAjaxloans()
			{
			    $this->visit('ajax/loans')
			         ->seePageIs('ajax/loans');
			}

			/**
			 * A ajax loans accounting functional.
			 *
			 * @return void
			 */
			public function testAjaxloansaccounting()
			{
			    $this->visit('ajax/loans/accounting')
			         ->seePageIs('ajax/loans/accounting');
			}

			/**
			 * A ajax regularisation functional.
			 *
			 * @return void
			 */
			public function testAjaxregularisation()
			{
			    $this->visit('ajax/regularisation')
			         ->seePageIs('ajax/regularisation');
			}

			/**
			 * A ajax regularisation accounting functional.
			 *
			 * @return void
			 */
			public function testAjaxregularisationaccounting()
			{
			    $this->visit('ajax/regularisation/accounting')
			         ->seePageIs('ajax/regularisation/accounting');
			}

			/**
			 * A files functional.
			 *
			 * @return void
			 */
			public function testFiles()
			{
			    $this->visit('files')
			         ->seePageIs('files');
			}

			/**
			 * A files get {filename?} functional.
			 *
			 * @return void
			 */
			public function testFilesgetfilename()
			{
			    $this->visit('files/get/1')
			         ->seePageIs('files/get/{filename?}');
			}

			/**
			 * A files add functional.
			 *
			 * @return void
			 */
			public function testFilesadd()
			{
			    $this->visit('files/add')
			         ->seePageIs('files/add');
			}

			/**
			 * A settings users functional.
			 *
			 * @return void
			 */
			public function testSettingsusers()
			{
			    $this->visit('settings/users')
			         ->seePageIs('settings/users');
			}

			/**
			 * A utility backup functional.
			 *
			 * @return void
			 */
			public function testUtilitybackup()
			{
			    $this->visit('utility/backup')
			         ->seePageIs('utility/backup');
			}

			/**
			 * A items functional.
			 *
			 * @return void
			 */
			public function testItems()
			{
			    $this->visit('items')
			         ->seePageIs('items');
			}

			/**
			 * A items add functional.
			 *
			 * @return void
			 */
			public function testItemsadd()
			{
			    $this->visit('items/add')
			         ->seePageIs('items/add');
			}

			/**
			 * A items edit {id} functional.
			 *
			 * @return void
			 */
			public function testItemseditid()
			{
			    $this->visit('items/edit/1')
			         ->seePageIs('items/edit/{id}');
			}

			/**
			 * A items delete {id} functional.
			 *
			 * @return void
			 */
			public function testItemsdeleteid()
			{
			    $this->visit('items/delete/1')
			         ->seePageIs('items/delete/{id}');
			}

			/**
			 * A js loanform functional.
			 *
			 * @return void
			 */
			public function testJsloanform()
			{
			    $this->visit('js/loanform')
			         ->seePageIs('js/loanform');
			}

			/**
			 * A js regularisationform functional.
			 *
			 * @return void
			 */
			public function testJsregularisationform()
			{
			    $this->visit('js/regularisationform')
			         ->seePageIs('js/regularisationform');
			}

			/**
			 * A logs functional.
			 *
			 * @return void
			 */
			public function testLogs()
			{
			    $this->visit('logs')
			         ->seePageIs('logs');
			}

			/**
			 * A pdf functional.
			 *
			 * @return void
			 */
			public function testPdf()
			{
			    $this->visit('pdf')
			         ->seePageIs('pdf');
			}

			/**
			 * A login functional.
			 *
			 * @return void
			 */
			public function testLogin()
			{
			    $this->visit('login')
			         ->seePageIs('login');
			}

			/**
			 * A logout functional.
			 *
			 * @return void
			 */
			public function testLogout()
			{
			    $this->visit('logout')
			         ->seePageIs('logout');
			}

			/**
			 * A sessions create functional.
			 *
			 * @return void
			 */
			public function testSessionscreate()
			{
			    $this->visit('sessions/create')
			         ->seePageIs('sessions/create');
			}

			/**
			 * A sessions store functional.
			 *
			 * @return void
			 */
			public function testSessionsstore()
			{
			    $this->visit('sessions/store')
			         ->seePageIs('sessions/store');
			}

			/**
			 * A sessions destroy functional.
			 *
			 * @return void
			 */
			public function testSessionsdestroy()
			{
			    $this->visit('sessions/destroy')
			         ->seePageIs('sessions/destroy');
			}

			/**
			 * A register functional.
			 *
			 * @return void
			 */
			public function testRegister()
			{
			    $this->visit('register')
			         ->seePageIs('register');
			}

			/**
			 * A register functional.
			 *
			 * @return void
			 */
			public function testRegister()
			{
			    $this->visit('register')
			         ->seePageIs('register');
			}

			/**
			 * A users activate {hash} {code} functional.
			 *
			 * @return void
			 */
			public function testUsersactivatehashcode()
			{
			    $this->visit('users/activate/1/2')
			         ->seePageIs('users/activate/{hash}/{code}');
			}

			/**
			 * A reactivate functional.
			 *
			 * @return void
			 */
			public function testReactivate()
			{
			    $this->visit('reactivate')
			         ->seePageIs('reactivate');
			}

			/**
			 * A reactivate functional.
			 *
			 * @return void
			 */
			public function testReactivate()
			{
			    $this->visit('reactivate')
			         ->seePageIs('reactivate');
			}

			/**
			 * A forgot functional.
			 *
			 * @return void
			 */
			public function testForgot()
			{
			    $this->visit('forgot')
			         ->seePageIs('forgot');
			}

			/**
			 * A forgot functional.
			 *
			 * @return void
			 */
			public function testForgot()
			{
			    $this->visit('forgot')
			         ->seePageIs('forgot');
			}

			/**
			 * A reset {hash} {code} functional.
			 *
			 * @return void
			 */
			public function testResethashcode()
			{
			    $this->visit('reset/1/2')
			         ->seePageIs('reset/{hash}/{code}');
			}

			/**
			 * A reset {hash} {code} functional.
			 *
			 * @return void
			 */
			public function testResethashcode()
			{
			    $this->visit('reset/1/2')
			         ->seePageIs('reset/{hash}/{code}');
			}

			/**
			 * A profile functional.
			 *
			 * @return void
			 */
			public function testProfile()
			{
			    $this->visit('profile')
			         ->seePageIs('profile');
			}

			/**
			 * A profile edit functional.
			 *
			 * @return void
			 */
			public function testProfileedit()
			{
			    $this->visit('profile/edit')
			         ->seePageIs('profile/edit');
			}

			/**
			 * A profile functional.
			 *
			 * @return void
			 */
			public function testProfile()
			{
			    $this->visit('profile')
			         ->seePageIs('profile');
			}

			/**
			 * A profile password functional.
			 *
			 * @return void
			 */
			public function testProfilepassword()
			{
			    $this->visit('profile/password')
			         ->seePageIs('profile/password');
			}

			/**
			 * A users functional.
			 *
			 * @return void
			 */
			public function testUsers()
			{
			    $this->visit('users')
			         ->seePageIs('users');
			}

			/**
			 * A users create functional.
			 *
			 * @return void
			 */
			public function testUserscreate()
			{
			    $this->visit('users/create')
			         ->seePageIs('users/create');
			}

			/**
			 * A users functional.
			 *
			 * @return void
			 */
			public function testUsers()
			{
			    $this->visit('users')
			         ->seePageIs('users');
			}

			/**
			 * A users {hash} functional.
			 *
			 * @return void
			 */
			public function testUsershash()
			{
			    $this->visit('users/1')
			         ->seePageIs('users/{hash}');
			}

			/**
			 * A users {hash} edit functional.
			 *
			 * @return void
			 */
			public function testUsershashedit()
			{
			    $this->visit('users/1/edit')
			         ->seePageIs('users/{hash}/edit');
			}

			/**
			 * A users {hash} password functional.
			 *
			 * @return void
			 */
			public function testUsershashpassword()
			{
			    $this->visit('users/1/password')
			         ->seePageIs('users/{hash}/password');
			}

			/**
			 * A users {hash} memberships functional.
			 *
			 * @return void
			 */
			public function testUsershashmemberships()
			{
			    $this->visit('users/1/memberships')
			         ->seePageIs('users/{hash}/memberships');
			}

			/**
			 * A users {hash} functional.
			 *
			 * @return void
			 */
			public function testUsershash()
			{
			    $this->visit('users/1')
			         ->seePageIs('users/{hash}');
			}

			/**
			 * A users {hash} functional.
			 *
			 * @return void
			 */
			public function testUsershash()
			{
			    $this->visit('users/1')
			         ->seePageIs('users/{hash}');
			}

			/**
			 * A users {hash} suspend functional.
			 *
			 * @return void
			 */
			public function testUsershashsuspend()
			{
			    $this->visit('users/1/suspend')
			         ->seePageIs('users/{hash}/suspend');
			}

			/**
			 * A users {hash} unsuspend functional.
			 *
			 * @return void
			 */
			public function testUsershashunsuspend()
			{
			    $this->visit('users/1/unsuspend')
			         ->seePageIs('users/{hash}/unsuspend');
			}

			/**
			 * A users {hash} ban functional.
			 *
			 * @return void
			 */
			public function testUsershashban()
			{
			    $this->visit('users/1/ban')
			         ->seePageIs('users/{hash}/ban');
			}

			/**
			 * A users {hash} unban functional.
			 *
			 * @return void
			 */
			public function testUsershashunban()
			{
			    $this->visit('users/1/unban')
			         ->seePageIs('users/{hash}/unban');
			}

			/**
			 * A groups functional.
			 *
			 * @return void
			 */
			public function testGroups()
			{
			    $this->visit('groups')
			         ->seePageIs('groups');
			}

			/**
			 * A groups create functional.
			 *
			 * @return void
			 */
			public function testGroupscreate()
			{
			    $this->visit('groups/create')
			         ->seePageIs('groups/create');
			}

			/**
			 * A groups functional.
			 *
			 * @return void
			 */
			public function testGroups()
			{
			    $this->visit('groups')
			         ->seePageIs('groups');
			}

			/**
			 * A groups {hash} functional.
			 *
			 * @return void
			 */
			public function testGroupshash()
			{
			    $this->visit('groups/1')
			         ->seePageIs('groups/{hash}');
			}

			/**
			 * A groups {hash} edit functional.
			 *
			 * @return void
			 */
			public function testGroupshashedit()
			{
			    $this->visit('groups/1/edit')
			         ->seePageIs('groups/{hash}/edit');
			}

			/**
			 * A groups {hash} functional.
			 *
			 * @return void
			 */
			public function testGroupshash()
			{
			    $this->visit('groups/1')
			         ->seePageIs('groups/{hash}');
			}

			/**
			 * A groups {hash} functional.
			 *
			 * @return void
			 */
			public function testGroupshash()
			{
			    $this->visit('groups/1')
			         ->seePageIs('groups/{hash}');
			}

			/**
			 * A translations view {group} functional.
			 *
			 * @return void
			 */
			public function testTranslationsviewgroup()
			{
			    $this->visit('translations/view/1')
			         ->seePageIs('translations/view/{group}');
			}

			/**
			 * A translations index {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsindexonetwothreefourfive()
			{
			    $this->visit('translations/index/1/2/3/4/5')
			         ->seePageIs('translations/index/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations functional.
			 *
			 * @return void
			 */
			public function testTranslations()
			{
			    $this->visit('translations')
			         ->seePageIs('translations');
			}

			/**
			 * A translations view {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsviewonetwothreefourfive()
			{
			    $this->visit('translations/view/1/2/3/4/5')
			         ->seePageIs('translations/view/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations add {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsaddonetwothreefourfive()
			{
			    $this->visit('translations/add/1/2/3/4/5')
			         ->seePageIs('translations/add/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations edit {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationseditonetwothreefourfive()
			{
			    $this->visit('translations/edit/1/2/3/4/5')
			         ->seePageIs('translations/edit/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations delete {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsdeleteonetwothreefourfive()
			{
			    $this->visit('translations/delete/1/2/3/4/5')
			         ->seePageIs('translations/delete/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations import {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsimportonetwothreefourfive()
			{
			    $this->visit('translations/import/1/2/3/4/5')
			         ->seePageIs('translations/import/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations find {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationsfindonetwothreefourfive()
			{
			    $this->visit('translations/find/1/2/3/4/5')
			         ->seePageIs('translations/find/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations publish {one?} {two?} {three?} {four?} {five?} functional.
			 *
			 * @return void
			 */
			public function testTranslationspublishonetwothreefourfive()
			{
			    $this->visit('translations/publish/1/2/3/4/5')
			         ->seePageIs('translations/publish/{one?}/{two?}/{three?}/{four?}/{five?}');
			}

			/**
			 * A translations {_missing} functional.
			 *
			 * @return void
			 */
			public function testTranslationsmissing()
			{
			    $this->visit('translations/1')
			         ->seePageIs('translations/{_missing}');
			}?>