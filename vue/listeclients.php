<?php include_once('head.php'); ?>
<style>
ul{list-style-type: none; padding-left:0px;}

.fuzzy-search{width:110px;text-align:center;margin-bottom:10px;}
</style>

<?php include_once('navbar.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Liste des locataires</h2>
      <p>
        <i class="fa fa-search"></i>
        <input type="text" id="recherche" onkeyup="searchbox()" placeholder="Rechercher.." title="searchbox">
        <i class="fa fa-cube" aria-hidden="true"></i> Meublé <i class="fa fa-bed" aria-hidden="true"></i> Chambre
        <a type="button" class="btn btn-primary pull-right btn-sm" href="client.php?action=new">Ajouter locataire</a>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h4>Locataires actifs  <i class="fa fa-eye"></i></h4>

      <table class="table table-bordered text-left table-fixed table-striped" id="tableau">
        <?php
        foreach($listeclient as $ligne)
        {
          ?>

          <tr>
            <td>
              <a href="client.php?action=afficher&cid=<?php echo $ligne['cid']?>"><i class="fa fa-eye"></i></a>
            </td>
            <td>
              <?php echo $ligne['cnom'] ?>
            </td>
            <td>
              <a href="./client.php?action=hide&cid=<?php echo $ligne['cid']?>"><i class="fa fa-arrow-down"></i>
              </a>
            </td>

          </tr>

          <?php
        }
        ?>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h4>Locataires inactifs  <i class="fa fa-eye-slash"></i></h4>
      <p>
        <i class="fa fa-search"></i>
        <input type="text" id="recherche2" onkeyup="searchbox2()" placeholder="Rechercher.." title="searchbox2">
      </p>
          <table class="table table-bordered text-left table-fixed table-striped" id="tableau2">

          <?php
          foreach($listeclienthide as $ligne)
          {
            ?>

            <tr>
              <td>
                <a href="client.php?action=afficher&cid=<?php echo $ligne['cid']?>"><i class="fa fa-eye"></i></a>
              </td>
              <td>
                <?php echo $ligne['cnom'] ?>
              </td>
              <td>
                <a href="./client.php?action=hide&cid=<?php echo $ligne['cid']?>"><i class="fa fa-arrow-up"></i>
                </a>
              </td>

            <?php
          }
          ?>
        </ul>
      </div>
    </div>
