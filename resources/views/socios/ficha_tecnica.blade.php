<style>
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }
  
  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
</style>

<div class="col-xs-12 col-sm-12 col-md-12">
  <div class="form-group">
    <label for="">Descargar ficha Tecnica</label>
    <br>
    <input type="button" class="btn btn-info" id="myBtn" value="Ficha Tecnica"></input>
  </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <button class="btn btn-primary form-control" type="submit">Guardar</button>
</div>

<div id="fichaModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <br>
    <h3>Descargar Ficha Tecnica</h3>
    <hr>
    <h5>
      Favor de descargar los siguientes <a href="">documentos</a> y llenar la ficha tecnica, firmarla, escanearla y volverla a subir.
    </h5>
  </div>
</div>

<script>
  var modal = document.getElementById("fichaModal");
  var btn = document.getElementById("myBtn");
  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
    modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
