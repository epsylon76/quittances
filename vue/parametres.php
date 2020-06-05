<div class="container">
  <div class="row">
    <h2>parametres</h2>
    <form action="chg_mail_psw.php" method="post">
    <div class="form-group">
      <label for="newpsw">Mot de passe actuel : <?php echo $_SESSION['mail_psw'];?></label>
      <input type="text" class="form-control" id="newpsw" name="new_psw" placeholder="Nouveau mot de passe">
    </div>
    <button type="submit" class="btn btn-default">Modifier</button>
  </form>
  </div>
</div>
