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

        <i class="fa fa-cube" aria-hidden="true"></i> Meublé <i class="fa fa-bed" aria-hidden="true"></i> Chambre
        <a type="button" class="btn btn-primary pull-right btn-sm" href="client.php?action=new">Ajouter locataire</a>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h3>Locataires actifs  <i class="fa fa-eye"></i></h3>

      <table class="table table-bordered text-left table-fixed table-striped" id="tab_locataires">
        <thead>
          <td>voir</td>
          <td>client</td>
          <td>inactiver</td>
        </thead>
        <tbody>
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
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <h3>Locataires inactifs  <i class="fa fa-eye-slash"></i></h3>
    <p>


    </p>
    <table class="table table-bordered text-left table-fixed table-striped" id="tab_locataires_inactifs">
      <thead>
        <td>voir</td>
        <td>client</td>
        <td>activer</td>
      </thead>
      <tbody>
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
      </tbody>
    </table>
      </ul>
    </div>
  </div>
