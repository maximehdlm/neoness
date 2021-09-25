



<h2>Connectes toi</h2>


    
<form action="./login" method="post" class="needs-validation" novalidate>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Prénom</label>
    <input type="text" class="form-control" name="prenomConnect" id="validationCustom01" pattern="[A-Za-z]{1-10}"  required>
    <div class="invalid-feedback">
        Prénom invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault02" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" name="mdpConnect"  required>
    <div class="invalid-feedback">
        Mdp requis !
      </div>
  </div>
  </div>

  <br>

    <button type="submit" name="connexion">connexion</button>

</form>





<h2>Pas de compte ? Crées en un et viens t'entraîner avec nous !</h2>

<form action="./inscription" method="post" class="needs-validation" novalidate>


<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ton nom</label>
    <input type="text" class="form-control" name="nom" id="validationCustom01" pattern="[A-Za-z]{1-20}" required>
    <div class="invalid-feedback">
        Prénom invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ton prenom</label>
    <input type="text" class="form-control" name="prenom" id="validationCustom01" pattern="[A-Za-z]{1-30}" required>
    <div class="invalid-feedback">
        Nom invalide !
      </div>
  </div>
  </div>
        
    <br>


<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ton téléphone</label>
    <input type="text" class="form-control" name="telephone" id="validationCustom04" pattern="(01|02|03|04|05|06|07|08|09)[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}" required>
    <div class="invalid-feedback">
        numéro de telephone invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ta dâte de naissance</label>
    <input type="date" class="form-control" name="ddn" id="validationDefault01" required>
    <div class="invalid-feedback">
        Date de naissance invalide !
      </div>
  </div>
  </div>
        
    <br>

    <div class="label51">      
        <input id="prodId" name="adherent" type="hidden" value="adherent">
    </div>

   
<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ton poids(en kg)</label>
    <input type="text" class="form-control" name="poids" id="validationDefault01" required>
    <div class="invalid-feedback">
        Poids invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ta taille(en cm)</label>
    <input type="text" class="form-control" name="taille" id="validationDefault01" required>
    <div class="invalid-feedback">
        Taille invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Ton poids visé</label>
    <input type="text" class="form-control" name="objectifs" id="validationDefault01" required>
    <div class="invalid-feedback">
        Poids idéal invalide !
      </div>
  </div>
  </div>
        
    <br>

<div class="row g-3">
  <div class="col-md-4 offset-4">
    <label for="validationDefault01" class="form-label">Choisis un mot de passe</label>
    <input type="password" class="form-control" name="mdp" id="validationDefault01" placeholder="tout caractères autorisés" required>
    <div class="invalid-feedback">
        Mot de passe requis !
      </div>
  </div>
  </div>
        
    <br>


    <button type="submit" name="inscription">s'inscrire</button>

</form>


