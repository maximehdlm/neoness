

    <?php   //je declare des variables et je leurs attribus les index de la table 
             $id = $liste['id'];
             $prenom = $_SESSION['prenom'];
             $countPoids = $liste['poids'];
             $countNom = $liste['nom'];
             $infoAge = $liste['YEAR(CURRENT_DATE) - YEAR(date_naissance)'];
             $infoTaille = $liste['taille'];
             $poidsIdeal = $liste['poids_ideal'];
             $poidsGain = $poidsIdeal - $countPoids;
             $poidsPerdu = $countPoids - $poidsIdeal ;
             $infoTailleM = $infoTaille/ 100;
             $imc = round($countPoids / (($infoTaille/100)*($infoTaille/100)),2);
             $nbBoucleUne = 1;
             $nbBoucleDeux = 1;

    ?>

    <h2>Salut <?= ucwords($prenom) ?> et bienvenue sur ton éspace.</h2>
    <p>Tu as <?= $infoAge ?> ans, l'âge de la maturité. </p>
    
    
    <?php 
    
            //sort le poids à prendre ou perde suivant ce qui a été inséré dans le poids_idéal
            if($poidsIdeal == $countPoids){
                echo "<p>Tu as atteind ton poids idéal, bien joué!</p>";
                
            }else if($poidsIdeal > $countPoids){
                echo "<p>Encore  ".$poidsGain." kg à gagner pour atteindre ton poids idéal.</p>";
                }else{
                    echo "<p>Encore  ".$poidsPerdu." kg à perdre pour atteindre ton poids idéal.</p>";
                }
                ?>



    <?php 

                //sort  l'imc suivant ce qui é été inséré dans le poids_idéal
                if($imc < 18.5){
                echo "<p>Ton imc actuel est de $imc, tu es trop mince, faits de la muscu pour prendre de la masse.</p>";
                }else if($imc > 25){
                    echo "<p>Ton imc actuel est de $imc, je te conseille du vélo ou du cross-fit pour griller des calories.</p>";
                }else{
                    echo "<p>Ton imc actuel est de $imc, tu es en forme, un peu de rameur peut-être ?</p>";
                };?>

<!-- graphique de l'imc -->
<div class="col-md-4 offset-3" id="curve_chart" style="width: 50%; height: 50%"></div>

<!-- formulaire pour les activités efféctuées -->

<div class="activite">
<form action="./sportifActivity" method="post" class="inscription">

<input type="hidden" name="id" id="id" value="<?php echo $id?>">

    <div class="labelModif">
        <label for="activite">Quelle activité as tu fais aujourd'hui,</label>
        <select name="activite">
            <option value="">Activité</option>
            <option value="1">vélo</option>
            <option value="2">tapis de course</option>
            <option value="3">rameur</option>
            <option value="4">cross-fit</option>
            <option value="5">musculation</option>
        </select>
        <select name="temps">
            <option value="">Durée</option>
            <option value="30">30 minutes</option>
            <option value="60">1 heure</option>
            <option value="120">2 heures</option>
            <option value="180">3 heures</option>
            <option value="240">4 heures</option>
        </select>

        <?php //lors de l'enregistrement de l'activité, enregistre la date actuelle
         $today = date("Y/n/j"); echo " le " .$today?>
         
        <input type="hidden" name="dateActivity" id="ddn" value="<?php echo $today?>">
               
    </div>

    <br>

    <button type="submit" name="nouvelleActivite">valider</button>
</form>
</div>

<!-- Affiche les 7 dernieres activités pratiqués  -->


<h2>Quelles activités as tu pratiqué ces 7 derniers jours</h2>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sport</th>
      <th scope="col">Durée</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>

<?php  foreach($listeActivitys as $activity): ?>
    <tr>
      <th scope="row"><?=$nbBoucleUne?></th>
        <td><?= $activity['nom_sport'] ?></td>
        <td><?= $activity['temps'] ?> min</td>
        <td><?= $activity['date'] ?></td>
      </tr>
<?php $nbBoucleUne++;?>
<?php endforeach ?>

  </tbody>
  </table>

<!-- affiche les activités sur les 30 derniers jours -->
<h2>Cliques pour afficher les activités as tu pratiqué ces 30 derniers jours</h2>
<div class="dbButton">
<button class="buttonA" type="button" id="b2">afficher</button>
<button class="buttonM" type="button" id="b1">masquer</button>
</div>


<div class="texte" style="display:none;">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Sport</th>
      <th scope="col">Durée</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>

<?php  foreach($listeActivitysMois as $activitys): ?>
    

    <tr>
      <th scope="row"><?=$nbBoucleDeux?></th>
      <td><?= $activitys['nom_sport'] ?></td>
        <td><?= $activitys['temps'] ?> min</td>
        <td><?= $activitys['date'] ?></td>
      </tr>
    <?php $nbBoucleDeux++;?>



<?php endforeach ?>

   </tbody>
  </table>
  </div>


<!-- formulaire pour modifier le poids -->

<form action="./modifPoidsPersonnel" method="post" class="needs-validation" novalidate>


    <div class="row g-3">
      <div class="col-md-4 offset-4">
        <label for="validationDefault01" class="form-label">Mon Poids actuel</label>
        <input type="text" class="form-control" name="poidsModif" id="validationCustom01" pattern="[0-9]{1-3}"  required>
    <div class="invalid-feedback">
        Poids invalide !
      </div>
    <input type="hidden" name="idTableImc" id="ddn" value="<?php echo $id?>">
    <input type="hidden" name="tailleTableImc" id="ddn" value="<?php echo $infoTaille?>">
    <input type="hidden" name="dateTableImc" id="ddn" value="<?php echo $today?>">
    <br>
    <button type="submit" name="nvPoids" id="b3">valider</button>
      </div>
    </div>
</form>



<!-- formulaire pour modifier le poids idéal -->

<form action="./modifPoidsIdealPersonnel" method="post" class="needs-validation" novalidate>

<div class="row g-3">
      <div class="col-md-4 offset-4">
        <label for="validationDefault02" class="form-label">Modifier mon poids idéal</label>
        <input type="text" class="form-control" name="poidsModifIdeal" id="validationCustom02" pattern="[0-9]{1-3}"  required>
        <div class="invalid-feedback">
        Poids idéal invalide !
      </div>
    <br>
    <button type="submit" name="nvPoidsIdeal" id="b4">valider</button>
    </div>
    </div>
</form>


<!-- formulaire pour modifier le numero de telephone -->

<form action="./modifNum" method="post" class="needs-validation" novalidate>

<div class="row g-3">
      <div class="col-md-4 offset-4">
        <label for="validationDefault02" class="form-label">Modifier mon numero de télephone</label>
        <input type="texte" class="form-control" name="modifNum" id="validationCustom05" pattern="(01|02|03|04|05|06|07|08|09)[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}" required>
        <div class="invalid-feedback">
        numéro de telephone invalide !
      </div>
    <br>
    <button type="submit" name="nvNum" id="b5">valider</button>
    </div>
    </div>
</form>


<!-- formulaire pour modifier le mot de passe -->

<form action="./modifMDP" method="post" class="needs-validation" novalidate>

<div class="row g-3">
      <div class="col-md-4 offset-4">
        <label for="validationDefault01" class="form-label">Modifier mon mot de passe</label>
        <input type="password" class="form-control" name="modifMDP" id="validationCustom03"  required>
        <input type="hidden" name="idMDP"  value="<?php echo $id?>">
        <div class="invalid-feedback">
        Mot de passe invalide !
      </div>
    <br>
    <button type="submit" name="nvMDP" id="b6">valider</button>
    </div>
    </div>
</form>



<!-- script googleChart pour le graphique -->
<script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['date', 'imc'],

        <?php 
        
          foreach($imcGraph AS $graph){
            echo '['.$graph['DAYOFMONTH(date_imc)'].', '.$graph['n_imc'].'],';
          }
        
        ?>
          
        ]);

        var options = {
          title: 'EVOLUTON DE MON IMC',
          hAxis: {title:'Résultat par jours', titleTextStyle: {color: '#333'}},
          vAxis: { minValue: 0 }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>




<!-- jquery pour les differents boutons -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>$(document).ready(function(){     
      
    

        $("#b1").click(function(){
            $(".texte").hide();
        });
        
        
        $("#b2").click(function(){
            $(".texte").show();
        });
    });

    

    </script>



    

             
    
    




