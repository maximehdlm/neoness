<?php $nbBoucle = 1;?>



<!-- Pour afficher la liste de tous les inscrits avec leurs infos, input et boutons pour modifier et supprimer compris -->
<table class="tableAdmin">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Telephone</th>
      <th scope="col">Date de naissance</th>
      <th scope="col">Age</th>
      <th scope="col">Poids</th>
      <th scope="col">Poids idéal</th>
      <th scope="col">Taille</th>
      <th scope="col">IMC</th>
      <th scope="col">Statut</th>
      <th scope="col">MDP</th>
      <th scope="col">Valider</th>
      <th scope="col">Supprimer</th>
    </tr>
      </thead>
        <tbody>

<?php foreach($liste_sportifs as $sportif): ?>

    <tr>
      <th scope="row"><?=$nbBoucle?></th>

<form action="./modifAdmin" method="post" class="modifAdmin">

<input type="hidden" name="id" value="<?php echo $sportif['id'] ?>" id="nom">

<td><p><?= $sportif['nom'] ?></p></td>
<td><p><?= $sportif['prenom'] ?></p></td>
<td><p><?= $sportif['telephone'] ?></p></td>
<td><p><?= $sportif['date_naissance'] ?></p></td>
<td><p><?= $sportif['YEAR(CURRENT_DATE) - YEAR(date_naissance)'] ?> ans</p></td>

    <td><div class="labelModif">
        <input type="text" name="modifPoids" value="<?= $sportif['poids'] ?>" id="nom">
    </div></td>


    <td><p><?= $sportif['poids_ideal'] ?></p></td>
    <td><p><?= $sportif['taille']/100 ?></p></td>
    <td><p><?= round($sportif['poids']/ (($sportif['taille']/100)*($sportif['taille']/100)),2)?></p></td>
<div class="statut">


    <td><div class="labelModif">
        <input type="text" name="modifStatut" value="<?= $sportif['statut'] ?>" id="nom">
    </div></td>
    <td><p><?= $sportif['mdp'] ?></p></td>
    <td><button class="adminV" type="submit" name="modifAdmin" >V</button></td>
    <td><button class="adminX" type="submit" name="supprAdmin" onclick="return confirm('Supprimer utilisateur ?')">X</button></td>

    

</form>
</div>
</tr>

<?php $nbBoucle++;?>
<?php endforeach ?>

    </tbody>
  </table>