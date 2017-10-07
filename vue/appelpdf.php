<?php
// Include the main TCPDF library (search for installation path).
require_once('./tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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


$html= '
<style type="text/css">
td {border:1px solid black;padding:10px}
.contenu{
  width:100%;
  padding:10px;
  margin:20px;
  border:1px solid green;
  border-collapse: collapse;
  font-size:15px;
}
.titre{font-size:45px;font-weight:bold;}
.periode{font-size:25px}
.case1{width:30%;font-size:13px;}
.case2{text-align:right;width:70%}
.case3{width:100%;padding-left:10%;font-size:20px;}
.case4{width:35%;}
.case5{width:25%;}
.case6{width:40%;}
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
<span class="titre">Appel de loyer</span>
<span class="periode">  de  '.$mois['nommois'].' '.$annee.'</span>
</td>
</tr>

<tr>
<td colspan="4" class="case3" >

<span class="titre4">M/Mme</span>&nbsp;&nbsp;'.$donneesclient['cnom'].'<span style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La somme de '.($loyer+$provision).' €</span><br>
<span class="titre5">Au titre du loyer et des charges du logement</span><br>

'.$donneeslogement['ldesc'].' '.$donneeslogement['letage'].'<br>
'.$donneeslogement['ladresse'].'<br>
'.$donneeslogement['lcp'].' '.$donneeslogement['lville'].'<br>
</td>
</tr>

<tr>
<td colspan="2" class="case4">
<h4>Détails de l\'appel</h4>
<table style="border:none;text-align:right;">
<tr>
<td style="border:none;">
Loyer
</td>
<td style="border:none;">
'.$loyer.'
</td>
</tr>

<tr>
<td style="border:none;">
Provisions
</td>
<td style="border:none;">
'.$loyer.'
</td>
</tr>

<tr>
<td style="border:none;">
Total
</td>
<td style=" border:none">
'.($loyer+$provision).'
</td>
</tr>
</table>
</td>

<td class="case5">

</td>
<td class="case6">

</td>
</tr>

</table>

';



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//maintenant soit on l'affiche soit on l'envoie par email
if($_POST['action']=="vue"){
  $pdf->Output('quittance'.$donneesclient['cnom'].'.pdf', 'I');
}

//envoi d'email
if($_POST['action']=="envoi")
{
  //sortie du fichier pdf vers une variable
  $fichier=$pdf->Output('quittance'.$donneesclient['cnom'].'.pdf', 'S');
  //script d'envoi, parametres mail
  include_once('./fct/sendpdf.php');
  //préparation des champs du mail
  $nompiecejointe="appel_de_loyer_".$mois['nommois']."_".$annee;
  //envoi vers nullmailer
  envoimail($donneessociete['snom'], $email,'votre appel de loyer de '.$mois['nommois'].' '.$annee,$message,$fichier,$nompiecejointe);
  //on met a jour la table quittance car elle a été envoyée

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
          <p><a class="btn btn-default btn-lg" href="contrat.php?action=modif&cnid=<?php echo $cnid; ?>">retour</a></p>
        </div>
      </div>
    </div>
  </div>
  <?php
}

include_once('./fct/scripts.php');
