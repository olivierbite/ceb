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
Entre Mr /Madame/Mlle  <strong>{names}</strong>, ayant le Num{{htmlspecialchars_decode('é')}}ro d'adh{{htmlspecialchars_decode('é')}}sion <strong>{adhersion_id}</strong> Domicili{{htmlspecialchars_decode('é')}} dans le District <strong>{district}</strong>  Province <strong>{province}</strong>. 
Membre de la Caisse d’Entraide de Butare,  d’une part : <br/>
Et le Conseil d’Administration de la Caisse d’Entraide de Butare repr{{htmlspecialchars_decode('é')}}sent{{htmlspecialchars_decode('é')}} par son Pr{{htmlspecialchars_decode('é')}}sident d’autre part.
</p>

<p>
IL EST LIBREMENT CONVENU CE QUI SUIT : <br/>
<p>
	<strong>Art 1.</strong> : Mr /Madame/Mlle<strong>{names}</strong>.employ{{htmlspecialchars_decode('é')}} (e) de <strong>{institution_name}</strong> reçoit un prêt de <strong>{loan_to_repay_word}</strong> Francs Rwandais, (<strong>{loan_to_repay}</strong> Frw) Par un Chèque N° <strong>{cheque_number}</strong>  remboursables en <strong>{tranches_number}</strong>. tranches de  <strong>{monthly_fees}</strong> Francs Rwandais par mois avec int{{htmlspecialchars_decode('é')}}rêts normaux de <strong>{interests}</strong> Francs et int{{htmlspecialchars_decode('é')}}rêts d’urgence de <strong>{urgent_loan_interests}</strong> Frw à d{{htmlspecialchars_decode('é')}}duire pr{{htmlspecialchars_decode('é')}}alablement sur la somme 
	prêt{{htmlspecialchars_decode('é')}}e.
</p>
<p>
   <strong>Art 2 :</strong> Le d{{htmlspecialchars_decode('é')}}biteur  s’engage à payer ces tranches à partir du mois de <strong>{start_payment_month}</strong>. jusque <strong>{end_payment_month}</strong> {{htmlspecialchars_decode('é')}}tant 
	entendu que l’{{htmlspecialchars_decode('é')}}ch{{htmlspecialchars_decode('é')}}ance totale est de <strong>{tranches_number}</strong>.  mois. La tranche mensuelle de remboursement est d{{htmlspecialchars_decode('é')}}duite sur son salaire par l’employeur conform{{htmlspecialchars_decode('é')}}ment à la demande de la CEB. 
</p>
<p>
	<strong>Art 3 :</strong> Le d{{htmlspecialchars_decode('é')}}biteur s’engage à rembourser les dites tranches conform{{htmlspecialchars_decode('é')}}ment aux clauses du règlement int{{htmlspecialchars_decode('é')}}rieur de la Caisse 
	d’Entraide de Butare, les cautions {{htmlspecialchars_decode('é')}}tant soumises au même règlement. En outre,  le d{{htmlspecialchars_decode('é')}}biteur ne peut pas pr{{htmlspecialchars_decode('é')}}tendre d{{htmlspecialchars_decode('é')}}missionner 
	de la C.E.B. avant l’{{htmlspecialchars_decode('é')}}puration de la dette.
</p>
<p>
	<strong>Art 4 :</strong> Ce prêt est solidairement cautionn{{htmlspecialchars_decode('é')}} par deux personnes membres effectifs de la CEB qui s’engagent solidairement à 
	rembourser en cas de d{{htmlspecialchars_decode('é')}}faillance du d{{htmlspecialchars_decode('é')}}biteur principal. 
</p>
<p>
	<strong>Art 5 :</strong> En cas de perte de la qualit{{htmlspecialchars_decode('é')}} du membre avant l’apurement de la dette ou le retard de remboursement de trois mois, le 
	d{{htmlspecialchars_decode('é')}}biteur accepte et autorise la CEB de se faire payer automatiquement par son {{htmlspecialchars_decode('é')}}pargne constitu{{htmlspecialchars_decode('é')}}e à la CEB. 
</p>
<p>
	<strong>Art 6 :</strong> Les cautionnaires acceptent solidairement que la CEB se fasse  payer automatiquement le solde du cr{{htmlspecialchars_decode('é')}}dit par leurs 
	{{htmlspecialchars_decode('é')}}pargnes à la CEB lorsque le d{{htmlspecialchars_decode('é')}}biteur d{{htmlspecialchars_decode('é')}}faillant totalise un retard de remboursement de 6 mois sans exiger pr{{htmlspecialchars_decode('é')}}alablement de 
	poursuivre le d{{htmlspecialchars_decode('é')}}biteur. Chaque cautionnaire consent et accepte de payer automatiquement tout solde du cr{{htmlspecialchars_decode('é')}}dit du d{{htmlspecialchars_decode('é')}}biteur qu’il 
	a cautionn{{htmlspecialchars_decode('é')}} même si l’{{htmlspecialchars_decode('é')}}pargne du d{{htmlspecialchars_decode('é')}}biteur et/ou du Co-cautionneur a {{htmlspecialchars_decode('é')}}t{{htmlspecialchars_decode('é')}} utilis{{htmlspecialchars_decode('é')}}e pour rembourser les autres cr{{htmlspecialchars_decode('é')}}dits qu’ils ont 
	cautionn{{htmlspecialchars_decode('é')}}s.
</p> 
<p>
	Le cautionnaire ne peut pas pr{{htmlspecialchars_decode('é')}}tendre d{{htmlspecialchars_decode('é')}}missionner de la CEB avant l’{{htmlspecialchars_decode('é')}}puration par le d{{htmlspecialchars_decode('é')}}biteur de la dette qu’il a cautionn{{htmlspecialchars_decode('é')}}e, 
	ou avant d’être remplac{{htmlspecialchars_decode('é')}} par un autre cautionnaire par le d{{htmlspecialchars_decode('é')}}biteur.
</p>
<p>Chacun des cautionnaires confirme avoir une parfaite connaissance de l’{{htmlspecialchars_decode('é')}}tendu de l’engagement de ce contrat et signe le </p>
<p>pr{{htmlspecialchars_decode('é')}}sent contrat en pr{{htmlspecialchars_decode('é')}}sence du membre du Conseil d’Administration de la CEB.</p>

<p>
	<strong>{cautionnaires_table}</strong>
</p>
<p>
	<strong>Art 7 :</strong> Le d{{htmlspecialchars_decode('é')}}biteur accepte et autorise la CEB qu’en cas de cessation du contrat de travail, soit par d{{htmlspecialchars_decode('é')}}mission volontaire, par suppression d’emploi ou par r{{htmlspecialchars_decode('é')}}vocation, de demander à son profit à son employeur de transf{{htmlspecialchars_decode('é')}}rer au compte de la Caisse d’Entraide de 
	Butare le d{{htmlspecialchars_decode('é')}}compte final pour rembourser son cr{{htmlspecialchars_decode('é')}}dit et/ou celui qu’il a cautionn{{htmlspecialchars_decode('é')}}. Le d{{htmlspecialchars_decode('é')}}biteur s’engage à remplacer chaque 
	cautionnaire qui se trouve dans l’impossibilit{{htmlspecialchars_decode('é')}} de continuer à cautionner son prêt. 
</p>
<p>
	<strong>Art 8 :</strong> Tout litige ou contestation r{{htmlspecialchars_decode('é')}}sultant de l’application et de l’interpr{{htmlspecialchars_decode('é')}}tation ou ex{{htmlspecialchars_decode('é')}}cution du pr{{htmlspecialchars_decode('é')}}sent contrat sera r{{htmlspecialchars_decode('é')}}gl{{htmlspecialchars_decode('é')}} à l’amiable. A d{{htmlspecialchars_decode('é')}}faut  le litige sera soumis à la juridiction rwandaise comp{{htmlspecialchars_decode('é')}}tente en la matière.
</p>
<p>
	<strong>Art 9 :</strong> Ce contrat entre en vigueur le jour de sa signature par les parties contractantes. Sign{{htmlspecialchars_decode('é')}} en deux exemplaires ayant la valeur originale et constitue le document de complet de r{{htmlspecialchars_decode('é')}}f{{htmlspecialchars_decode('é')}}rences des obligations r{{htmlspecialchars_decode('é')}}ciproques entre les parties contractantes.
</p>

<p style="text-align: center">Fait à Huye, le <strong>{today_date}</strong>.</p>
<div class="container">
	<div class="left">
	<h4 style="text-decoration: underline">L'emprunteur:</h4>
	Nom & Pr{{htmlspecialchars_decode('é')}}nom: {names} <br/>
    District : {district}, Province {province} <br/>
	Carte d’Identit{{htmlspecialchars_decode('é')}} N° : {member_nid} <br/>
	Signature: ................................................................<br/>
</div>

<div class="right">
	<h4 style="text-decoration: underline">Pour le Conseil d’Administration de la CEB</h4>
	Pr{{htmlspecialchars_decode('é')}}sident : {president}<br/>
	Signature: ...................................................................................<br/>
	Tr{{htmlspecialchars_decode('é')}}sorier: {treasurer} <br/>
	Signature: .................................................................................<br/>
	Administrateur:{administrator}<br/>
	Signature: ....................................................................................<br/>.
</div>
</div>
