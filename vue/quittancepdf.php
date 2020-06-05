<?php
// Include the main TCPDF library (search for installation path).
require_once('./tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// changer la date au 15 du mois si elle n'est pas défann_cascadetrain_on_file
if($donneesquittance['datepaiement']=="0000-00-00")
{
  $donneesquittance['datepaiement']=$annee.'-'.$mois['nomois'].'-15';
}


$html= '
<style type="text/css">
td {border:1px solid black;padding:10px}
.contenu{
  width:100%;
  padding:10px;
  margin:20px;
  border:1px solid green;
  border-collapse: collapse;
  font-size:12px;
}
.titre{font-size:25px;font-weight:bold;}
.periode{font-size:15px}
.case1{width:30%;font-size:13px;}
.case2{text-align:right;width:70%}
.case3{width:50%;padding-left:10%;font-size:15px;}
.case4{width:35%;}
.case5{width:25%;}
.case6{width:40%;}
.texte{font-size:15px;font-weight:500;}
.titre4{font-weight:bold;}
.titre5{font-size:12px;}

.alignleft {float: left;width:33.33333%;text-align:left;}
.aligncenter {float: left;width:33.33333%;text-align:center;}
.alignright {float: left;width:33.33333%;text-align:right;}​



</style>


<table class="contenu">

<tr>
<td class="case1">

'.$donneessociete['snom'].'<br>
'.$donneessociete['sadresse'].'<br>
'.$donneessociete['scp'].' '.$donneessociete['sville'].'
</td>
<td colspan="3" class="case2">
<span class="titre">Quittance de loyer</span><br>';

if($donneesquittance['datedebut'] != '0000-00-00' && $donneesquittance['datefin'] != '0000-00-00'){
  $html .= '<span class="periode">du  '.date_unix_humain($donneesquittance['datedebut']).' au '.date_unix_humain($donneesquittance['datefin']).'</span>';
}else{
  $html .= '<span class="periode">de  '.$mois['nommois'].' '.$annee.'</span>';
}



$html .=
'</td>
</tr>

<tr>
<td colspan="2" class="case3" >

<span class="titre4">Recu de M/Mme</span>&nbsp;&nbsp;'.$donneesclient['cnom'].'<br>
<span style="font-size:15px;">La somme de '.($donneesquittance['qloyer']+$donneesquittance['qprov']).' €</span><br>
<span class="titre5">Au titre du loyer et des charges du logement</span><br>

'.$donneeslogement['ldesc'].' '.$donneeslogement['letage'].'<br>
'.$donneeslogement['ladresse'].'<br>
'.$donneeslogement['lcp'].' '.$donneeslogement['lville'].'<br>
</td>

<td colspan="2" class="case3" >
<span class="texte">'.$donneesquittance['qnote'].'</span>
</td>

</tr>

<tr>
<td colspan="2" class="case4">
<h4>Détails de la quittance</h4>
<table style="border:none;text-align:right;">
<tr>
<td style="border:none;">
Loyer
</td>
<td style="border:none;">
'.$donneesquittance['qloyer'].'
</td>
</tr>

<tr>
<td style="border:none;">
Provisions
</td>
<td style="border:none;">
'.$donneesquittance['qprov'].'
</td>
</tr>

<tr>
<td style="border:none;">
Total
</td>
<td style=" border:none">
'.($donneesquittance['qloyer']+$donneesquittance['qprov']).'
</td>
</tr>
</table>
</td>

<td class="case5">
<h4>Signature</h4>
<img src="'.$donneessociete['urltampon'].'" style="height:100px;">
</td>
<td class="case6">
<span class="titre4">Date du Règlement :</span> '.date_unix_humain($donneesquittance['datepaiement']).'<br>
Dont quittance et sous réserve de tous mes droits<br>
à '.$donneessociete['sville'].'<br>
Le '.date_unix_humain($donneesquittance['dateedition']).'<br>
</td>
</tr>

</table>

';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//maintenant soit on l'affiche soit on l'envoie par email
if($_GET['pdf']=="vuepdf"){
  $pdf->Output('quittance'.$donneesclient['cnom'].'.pdf', 'I');
}

//envoi d'email
if($_GET['pdf']=="envoipdf")
{
  //sortie du fichier pdf vers une variable
  $fichier=$pdf->Output('quittance'.$donneesclient['cnom'].'.pdf', 'S');
  //script d'envoi, parametres mail
  include_once('./fct/sendpdf.php');
  //préparation des champs du mail
  $nompiecejointe="quittance_de_loyer_".$mois['nommois']."_".$annee;
  //envoi vers nullmailer
  envoimail($donneessociete['snom'], $email,'votre quittance de '.$mois['nommois'].' '.$annee,$message,$fichier,$nompiecejointe);
  //on met a jour la table quittance car elle a été envoyée
  $requete = $bdd->prepare("UPDATE `quittance` SET `dateenvoi` = now() WHERE `qid` = :qid");
  $donnees=array('qid'=>$donneesquittance['qid']);
  if (!$requete->execute($donnees)) {
    echo "Echec lors de l'exécution : (" . $requete->errno . ") " . $requete->error;
  }

  include('./vue/head.php');
  ?>
  <div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
      <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title">Email</h3>
        </div>
        <div class="panel-body">
          <p>Email envoyé avec succès</p>
          <p><a class="btn btn-default btn-lg" href="quittance.php?action=modif&qid=<?php echo $_GET['qid']; ?>">retour</a></p>
        </div>
      </div>
    </div>
  </div>
  <?php
}

include_once('./fct/scripts.php');
