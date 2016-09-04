<style type="text/css" media="print">
	/** @type {PRINT IN LANDSCAPE}  */
 @media print{@page {size: portrait}}
</style>

<script type="text/javascript">
   window.open("{!! route('piece.disbursed.account',['transactionid'=>$transactionid,'export_excel'=>0]) !!}", "_blank");
  window.focus();
</script>
<h3 style="text-align: center;text-decoration: underline">CONTRAT DE PRÊT ET DE CAUTIONNEMENT SOLIDAIRE N° {contract_id}</h3>
<p>
Entre Mr /Madame/Mlle  <strong>{names}</strong>, ayant le Numéro d'adhésion <strong>{adhersion_id}</strong> Domicilié dans le District <strong>{district}</strong>  Province <strong>{province}</strong>. 
Membre de la Caisse d'Entraide de Butare,  d'une part : <br/>
Et le Conseil d'Administration de la Caisse d'Entraide de Butare représenté par son Président d'autre part.
>>>>>>> df043422ea44ab356ce9eb8a2780fee313a3b51c
</p>

<p>
IL EST LIBREMENT CONVENU CE QUI SUIT : <br/>
<p>

	<strong>Art 1.</strong> : Mr /Madame/Mlle<strong>{names}</strong>.employé (e) de <strong>{institution_name}</strong> reçoit un prêt de <strong>{loan_to_repay_word}</strong> Francs Rwandais, (<strong>{loan_to_repay}</strong> Frw) Par un Chèque N° <strong>{cheque_number}</strong>  remboursables en <strong>{tranches_number}</strong>. tranches de  <strong>{monthly_fees}</strong> Francs Rwandais par mois avec intérêts normaux de <strong>{interests}</strong> Francs et intérêts d'urgence de <strong>{urgent_loan_interests}</strong> Frw à déduire préalablement sur la somme 
	prêtée.
</p>
<p>
   <strong>Art 2 :</strong> Le débiteur  s'engage à payer ces tranches à partir du mois de <strong>{start_payment_month}</strong>. jusque <strong>{end_payment_month}</strong> étant 
	entendu que l'échéance totale est de <strong>{tranches_number}</strong>.  mois. La tranche mensuelle de remboursement est déduite sur son salaire par l'employeur conformément à la demande de la CEB. 
</p>
<p>
	<strong>Art 3 :</strong> Le débiteur s'engage à rembourser les dites tranches conformément aux clauses du règlement intérieur de la Caisse 
	d'Entraide de Butare, les cautions étant soumises au même règlement. En outre,  le débiteur ne peut pas prétendre démissionner 
	de la C.E.B. avant l'épuration de la dette.
</p>
<p>
	<strong>Art 4 :</strong> Ce prêt est solidairement cautionné par deux personnes membres effectifs de la CEB qui s'engagent solidairement à 
	rembourser en cas de défaillance du débiteur principal. 
</p>
<p>
	<strong>Art 5 :</strong> En cas de perte de la qualité du membre avant l'apurement de la dette ou le retard de remboursement de trois mois, le 
	débiteur accepte et autorise la CEB de se faire payer automatiquement par son épargne constituée à la CEB. 
</p>
<p>
	<strong>Art 6 :</strong> Les cautionnaires acceptent solidairement que la CEB se fasse  payer automatiquement le solde du crédit par leurs 
	épargnes à la CEB lorsque le débiteur défaillant totalise un retard de remboursement de 6 mois sans exiger préalablement de 
	poursuivre le débiteur. Chaque cautionnaire consent et accepte de payer automatiquement tout solde du crédit du débiteur qu'il 
	a cautionné même si l'épargne du débiteur et/ou du Co-cautionneur a été utilisée pour rembourser les autres crédits qu'ils ont 
	cautionnés.
</p> 
<p>
	Le cautionnaire ne peut pas prétendre démissionner de la CEB avant l'épuration par le débiteur de la dette qu'il a cautionnée, 
	ou avant d'être remplacé par un autre cautionnaire par le débiteur.
</p>
<p>Chacun des cautionnaires confirme avoir une parfaite connaissance de l'étendu de l'engagement de ce contrat et signe le </p>
<p>présent contrat en présence du membre du Conseil d'Administration de la CEB.</p>
>>>>>>> df043422ea44ab356ce9eb8a2780fee313a3b51c

<p>
	<strong>{cautionnaires_table}</strong>
</p>
<p>
<<<<<<< HEAD
	<strong>Art 7 :</strong> Le d{{htmlspecialchars_decode('é')}}biteur accepte et autorise la CEB qu’en cas de cessation du contrat de travail, soit par d{{htmlspecialchars_decode('é')}}mission volontaire, par suppression d’emploi ou par r{{htmlspecialchars_decode('é')}}vocation, de demander à son profit à son employeur de transf{{htmlspecialchars_decode('é')}}rer au compte de la Caisse d’Entraide de 
	Butare le d{{htmlspecialchars_decode('é')}}compte final pour rembourser son cr{{htmlspecialchars_decode('é')}}dit et/ou celui qu’il a cautionn{{htmlspecialchars_decode('é')}}. Le d{{htmlspecialchars_decode('é')}}biteur s’engage à remplacer chaque 
	cautionnaire qui se trouve dans l’impossibilit{{htmlspecialchars_decode('é')}} de continuer à cautionner son prêt. 
</p>
<p>
	<strong>Art 8 :</strong> Tout litige ou contestation r{{htmlspecialchars_decode('é')}}sultant de l’application et de l’interpr{{htmlspecialchars_decode('é')}}tation ou ex{{htmlspecialchars_decode('é')}}cution du pr{{htmlspecialchars_decode('é')}}sent contrat sera r{{htmlspecialchars_decode('é')}}gl{{htmlspecialchars_decode('é')}} à l’amiable. A d{{htmlspecialchars_decode('é')}}faut  le litige sera soumis à la juridiction rwandaise comp{{htmlspecialchars_decode('é')}}tente en la matière.
</p>
<p>
	<strong>Art 9 :</strong> Ce contrat entre en vigueur le jour de sa signature par les parties contractantes. Sign{{htmlspecialchars_decode('é')}} en deux exemplaires ayant la valeur originale et constitue le document de complet de r{{htmlspecialchars_decode('é')}}f{{htmlspecialchars_decode('é')}}rences des obligations r{{htmlspecialchars_decode('é')}}ciproques entre les parties contractantes.
=======
	<strong>Art 7 :</strong> Le débiteur accepte et autorise la CEB qu'en cas de cessation du contrat de travail, soit par démission volontaire, par suppression d'emploi ou par révocation, de demander à son profit à son employeur de transférer au compte de la Caisse d'Entraide de 
	Butare le décompte final pour rembourser son crédit et/ou celui qu'il a cautionné. Le débiteur s'engage à remplacer chaque 
	cautionnaire qui se trouve dans l'impossibilité de continuer à cautionner son prêt. 
</p>
<p>
	<strong>Art 8 :</strong> Tout litige ou contestation résultant de l'application et de l'interprétation ou exécution du présent contrat sera réglé à l'amiable. A défaut  le litige sera soumis à la juridiction rwandaise compétente en la matière.
</p>
<p>
	<strong>Art 9 : </strong> Ce contrat entre en vigueur le jour de sa signature par les parties contractantes. Signé en deux exemplaires ayant la valeur originale et constitue le document de complet de références des obligations réciproques entre les parties contractantes.
>>>>>>> df043422ea44ab356ce9eb8a2780fee313a3b51c
</p>

<p style="text-align: center">Fait à Huye, le <strong>{today_date}</strong>.</p>
<div class="container">
	<div class="left">
	<h4 style="text-decoration: underline">L'emprunteur:</h4>
	Nom & Pr{{htmlspecialchars_decode('é')}}nom: {names} <br/>
    District : {district}, Province {province} <br/>
<<<<<<< HEAD
	Carte d’Identit{{htmlspecialchars_decode('é')}} N° : {member_nid} <br/>
=======
	Carte d'Identité N° : {member_nid} <br/>
>>>>>>> df043422ea44ab356ce9eb8a2780fee313a3b51c
	Signature: ................................................................<br/>
</div>

<div class="right">
<<<<<<< HEAD
	<h4 style="text-decoration: underline">Pour le Conseil d’Administration de la CEB</h4>
	Pr{{htmlspecialchars_decode('é')}}sident : {president}<br/>
=======
	<h4 style="text-decoration: underline">Pour le Conseil d'Administration de la CEB</h4>
	Président : {president}<br/>
>>>>>>> df043422ea44ab356ce9eb8a2780fee313a3b51c
	Signature: ...................................................................................<br/>
	Tr{{htmlspecialchars_decode('é')}}sorier: {treasurer} <br/>
	Signature: .................................................................................<br/>
	Administrateur:{administrator}<br/>
	Signature: ....................................................................................<br/>.
</div>
</div>
