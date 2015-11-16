<<<<<<< HEAD
<p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: center;"><span id="docs-internal-guid-cd799d0a-7906-7776-48e1-dc64291f0427"><span style="font-size: 17.3333333333333px; font-family: Garamond; color: rgb(0, 0, 0); font-weight: 700; text-decoration: underline; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">CONTRAT DE PR&Ecirc;T ET DE CAUTIONNEMENT SOLIDAIRE N&deg;{!! $member->latestLoan()->loan_contract !!}</span></span></p>
<br/>
<p class="c0"><span class="c4">Entre Mr /Madame/M</span><span class="c4 c10">lle</span><span class="c4">&nbsp; </span>
<span class="c2" style="font-weight: 700;">{!! $member->names !!}, </span><span class="c4">ayant le Numéro d'adhésion</span><span class="c2" style="font-weight: 700;">&nbsp;
{!! $member->adhersion_id !!}.</span></p><p class="c0"><span class="c4">Domicilié dans le District </span><span class="c2" style="font-weight: 700;">{!! $member->district !!}.</span><span class="c4">&nbsp; Province </span><span class="c2" style="font-weight: 700;">{!! $member->province !!}.</span><span class="c4">&nbsp;</span></p><p class="c0"><span class="c4">Membre de la Caisse d’Entraide de Butare, &nbsp;d’une part :</span></p><p class="c0"><span class="c4">Et le Conseil d’Administration de la Caisse d’Entraide de Butare représenté par son Président d’autre part.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c4">IL EST LIBREMENT CONVENU CE QUI SUIT :</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c3">Art 1.</span><span class="c4">&nbsp;: Mr /Madame/M</span><span class="c4 c10">lle</span><span class="c4" style="font-weight: 700;"> {!! $member->names !!} </span> employé (e) de <span style="font-weight: 700;"> {!! $member->institution_name !!} </span></p><p class="c0"><span class="c4">reçoit un prêt de &nbsp;</span>
<span class="c2" style="font-weight: 700;"> {!! convert_number_to_words($member->loan_balance) !!} Francs Rwandais, ({!! $member->loan_balance !!}Frw)</span></p><p class="c0"><span class="c4">Par un Chèque N° </span>
<span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->cheque_number !!}</span><span class="c4">&nbsp; remboursables en </span><span class="c2" style="font-weight: 700;"></span><span class="c4">&nbsp;tranches de &nbsp;</span>
<span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->monthly_fees !!} Francs Rwandais </span><span class="c4">par mois avec intérêts normaux de </span><span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->interests !!} </span><span class="c4">&nbsp;Francs et intérêts d’urgence de</span><span class="c2" style="font-weight: 700;"> {!! $member->latestLoan()->urgent_loan_interests !!}.</span><span class="c4">Frw à déduire préalablement sur la somme prêtée.</span></p><p class="c0"><span class="c3">Art 2</span><span class="c4">&nbsp;: Le débiteur &nbsp;s’engage à payer ces tranches à partir du mois de </span><span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->letter_date->addMonth(1)->Format('M-Y') !!} </span><span class="c4">jusque </span><span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->letter_date->addMonth($member->latestLoan()->tranches_number + 1)->Format('M-Y') !!} </span><span class="c4">étant entendu que l’échéance totale est de </span><span class="c2" style="font-weight: 700;">{!! $member->latestLoan()->tranches_number !!} </span><span class="c4">&nbsp; mois. La tranche mensuelle de remboursement est déduite sur son salaire par l’employeur conformément à la demande de la CEB. </span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c3">Art 3</span><span class="c4">&nbsp;: Le débiteur s’engage à rembourser les dites tranches conformément aux clauses du règlement intérieur de la Caisse d’Entraide de Butare, les cautions étant soumises au même règlement. En outre, &nbsp;le débiteur ne peut pas prétendre démissionner de la C.E.B. avant l’épuration de la dette.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c3">Art 4</span><span class="c4">&nbsp;: Ce prêt est solidairement cautionné par deux personnes membres effectifs de la CEB qui s’engagent solidairement à rembourser en cas de défaillance du débiteur principal. </span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c4">Art. 5&nbsp;: En cas de perte de la qualité du membre avant l’apurement de la dette ou le retard de remboursement de trois mois, le débiteur accepte et autorise la CEB de se faire payer automatiquement par son épargne constituée à la CEB. </span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c4">Art. 6&nbsp;: Les cautionnaires acceptent solidairement que la CEB se fasse &nbsp;payer automatiquement le solde du crédit par leurs épargnes à la CEB lorsque le débiteur défaillant totalise un retard de remboursement de 6 mois sans exiger préalablement de poursuivre le débiteur. Chaque cautionnaire consent et accepte de payer automatiquement tout solde du crédit du débiteur qu’il a cautionné même si l’épargne du débiteur et/ou du Co-cautionneur a été utilisée pour rembourser les autres crédits qu’ils ont cautionnés. </span></p><p class="c0"><span class="c4">Le cautionnaire ne peut pas prétendre démissionner de la CEB avant l’épuration par le débiteur de la dette qu’il a cautionnée, ou avant d’être remplacé par un autre cautionnaire par le débiteur.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c4">Chacun des cautionnaires confirme avoir une parfaite connaissance de l’étendu de l’engagement de ce contrat et signe le présent contrat en présence du membre du Conseil d’Administration de la CEB.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0 c1"><span class="c4"></span></p>
 @include('reports.cautionneurs')
<p class="c0"><span class="c5">Art 7 : Le débiteur accepte et autorise la CEB qu’en cas de cessation du contrat de travail, soit par démission volontaire, par suppression d’emploi ou par révocation, de demander à son profit à son employeur de transférer au compte de la Caisse d’Entraide de Butare le décompte final pour rembourser son crédit et/ou celui qu’il a cautionné. Le débiteur s’engage à remplacer chaque cautionnaire qui se trouve dans l’impossibilité de continuer à cautionner son prêt. </span></p><p class="c0"><span class="c5">&nbsp;</span></p><p class="c0"><span class="c5">Art 8 : Tout litige ou contestation résultant de l’application et de l’interprétation ou exécution du présent contrat sera réglé à l’amiable. A défaut &nbsp;le litige sera soumis à la juridiction rwandaise compétente en la matière.</span></p><p class="c0 c1"><span class="c5"></span></p><p class="c0"><span class="c5">Art. 9&nbsp;: Ce contrat entre en vigueur le jour de sa signature par les parties contractantes. Signé en deux exemplaires ayant la valeur originale et constitue le document de complet de références des obligations réciproques entre les parties contractantes.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fait à Huye, le {!! date('d/m/Y') !!}.</span></p><p class="c0 c1"><span class="c4"></span></p><p class="c0"><span class="c2">Nr</span><span class="c4">&nbsp;</span><span class="c2">d'adhésion</span></p><p class="c0"><span class="c2">Noms</span></p><p class="c0"><span class="c2">Nr CI</span></p><p class="c0"><span class="c2">District</span></p>
<p class="c0"><span class="c2 c8">L'emprunteur:</span></p><p class="c0"><span class="c5">Nom &amp; Prénom: </span><span class="c5 c9">…………..</span></p><p class="c0"><span class="c5">District : </span><span class="c5 c9">………
=======
<style type="text/css" media="print">
	/** @type {PRINT IN LANDSCAPE}  */
 @media print{@page {size: portrait}}
</style>
<h3 style="text-align: center;text-decoration: underline">CONTRAT DE PRÊT ET DE CAUTIONNEMENT SOLIDAIRE N° {contract_id}</h3>

<p>
Entre Mr /Madame/Mlle  <strong>{names}</strong>, ayant le Numéro d'adhésion <strong>{adhersion_id}</strong> Domicilié dans le District <strong>{district}</strong>  Province <strong>{province}</strong>. 
Membre de la Caisse d’Entraide de Butare,  d’une part : <br/>
Et le Conseil d’Administration de la Caisse d’Entraide de Butare représenté par son Président d’autre part.
</p>

<p>
IL EST LIBREMENT CONVENU CE QUI SUIT : <br/>
<p>
	<strong>Art 1.</strong> : Mr /Madame/Mlle<strong>{names}</strong>.employé (e) de <strong>{institution_name}</strong> reçoit un prêt de <strong>{loan_to_repay_word}</strong> Francs Rwandais, (<strong>{loan_to_repay}</strong> Frw) Par un Chèque N° <strong>{cheque_number}</strong>  remboursables en <strong>{tranches_number}</strong>. tranches de  <strong>{monthly_fees}</strong> Francs Rwandais par mois avec intérêts normaux de <strong>{interests}</strong> Francs et intérêts d’urgence de <strong>{urgent_loan_interests}</strong> Frw à déduire préalablement sur la somme 
	prêtée.
</p>
<p>
   <strong>Art 2 :</strong> Le débiteur  s’engage à payer ces tranches à partir du mois de <strong>{start_payment_month}</strong>. jusque <strong>{end_payment_month}</strong> étant 
	entendu que l’échéance totale est de <strong>{tranches_number}</strong>.  mois. La tranche mensuelle de remboursement est déduite sur son salaire par l’employeur conformément à la demande de la CEB. 
</p>
<p>
	<strong>Art 3 :</strong> Le débiteur s’engage à rembourser les dites tranches conformément aux clauses du règlement intérieur de la Caisse 
	d’Entraide de Butare, les cautions étant soumises au même règlement. En outre,  le débiteur ne peut pas prétendre démissionner 
	de la C.E.B. avant l’épuration de la dette.
</p>
<p>
	<strong>Art 4 :</strong> Ce prêt est solidairement cautionné par deux personnes membres effectifs de la CEB qui s’engagent solidairement à 
	rembourser en cas de défaillance du débiteur principal. 
</p>
<p>
	<strong>Art 5 :</strong> En cas de perte de la qualité du membre avant l’apurement de la dette ou le retard de remboursement de trois mois, le 
	débiteur accepte et autorise la CEB de se faire payer automatiquement par son épargne constituée à la CEB. 
</p>
<p>
	<strong>Art 6 :</strong> Les cautionnaires acceptent solidairement que la CEB se fasse  payer automatiquement le solde du crédit par leurs 
	épargnes à la CEB lorsque le débiteur défaillant totalise un retard de remboursement de 6 mois sans exiger préalablement de 
	poursuivre le débiteur. Chaque cautionnaire consent et accepte de payer automatiquement tout solde du crédit du débiteur qu’il 
	a cautionné même si l’épargne du débiteur et/ou du Co-cautionneur a été utilisée pour rembourser les autres crédits qu’ils ont 
	cautionnés.
</p> 
<p>
	Le cautionnaire ne peut pas prétendre démissionner de la CEB avant l’épuration par le débiteur de la dette qu’il a cautionnée, 
	ou avant d’être remplacé par un autre cautionnaire par le débiteur.
</p>
<p>Chacun des cautionnaires confirme avoir une parfaite connaissance de l’étendu de l’engagement de ce contrat et signe le </p>
<p>présent contrat en présence du membre du Conseil d’Administration de la CEB.</p>

<p>
	<strong>{cautionnaires_table}</strong>
</p>
<p>
	<strong>Art 7 :</strong> Le débiteur accepte et autorise la CEB qu’en cas de cessation du contrat de travail, soit par démission volontaire, par suppression d’emploi ou par révocation, de demander à son profit à son employeur de transférer au compte de la Caisse d’Entraide de 
	Butare le décompte final pour rembourser son crédit et/ou celui qu’il a cautionné. Le débiteur s’engage à remplacer chaque 
	cautionnaire qui se trouve dans l’impossibilité de continuer à cautionner son prêt. 
</p>
<p>
	<strong>Art 8 :</strong> Tout litige ou contestation résultant de l’application et de l’interprétation ou exécution du présent contrat sera réglé à l’amiable. A défaut  le litige sera soumis à la juridiction rwandaise compétente en la matière.
</p>
<p>
	<strong>Art 9 :</strong> Ce contrat entre en vigueur le jour de sa signature par les parties contractantes. Signé en deux exemplaires ayant la valeur originale et constitue le document de complet de références des obligations réciproques entre les parties contractantes.
</p>

<p style="text-align: center">Fait à Huye, le <strong>{today_date}</strong>.</p>
<div class="container">
	<div class="left">
	<h4 style="text-decoration: underline">L'emprunteur:</h4>
	Nom & Prénom: {names} <br/>
    District : {district}, Province {province} <br/>
	Carte d’Identité N° : {member_nid} <br/>
	Signature: ................................................................<br/>
</div>

<div class="right">
	<h4 style="text-decoration: underline">Pour le Conseil d’Administration de la CEB</h4>
	Président : {president}<br/>
	Signature: ...................................................................................<br/>
	Trésorier: {treasurer} <br/>
	Signature: .................................................................................<br/>
	Administrateur:{administrator}<br/>
	Signature: ....................................................................................<br/>.
</div>
</div>
>>>>>>> 2a2f74a2e51cac2117f42fba5566f8375eee55a8
