<p>
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">Firma Digital</button>
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Capturar / Subir foto</button>
</p>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
        <div class="">
            <canvas id="canvas" style="border: 1px solid black;"></canvas>
            <br>
            <input type="button" class="btn btn-success" id="btnDescargar" value="Guardar" />
            <input type="button" class="btn btn-secondary" id="btnLimpiar" value="Limpiar" />
            <input type="hidden" name="signData" id="signData">
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
        <div class="row">
            <div class="col">
                <label for="">Tomar foto</label>
                <div>
                    <div id="myCamera"></div>
                    <input type="button" class="btn btn-success" onClick="takeSnapshot();" value="Tomar Foto" />
                </div>
                <div>
                    <div id="results"></div>
                    <div id="text" hidden></div>
                </div>
            </div>
            <div class="col">
                <label for="">Subir foto</label>
                <input type="file" name="image" id="upload_photo">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
    //-----------------------------------
    //Firma Digital
    //-----------------------------------
    const $canvas = document.getElementById('canvas');
    const $btnDescargar = document.getElementById('btnDescargar');
    const $btnLimpiar = document.getElementById('btnLimpiar');
    const $signSave = document.getElementById('signData');
    const contexto = $canvas.getContext('2d');
    const COLOR_PINCEL = '#000000';
    const COLOR_FONDO = '#FFFFFF';
    const GROSOR = 1.5;
    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;
    const obtenerXReal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
    const obtenerYReal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
    let haComenzadoDibujo = false;
    $canvas.addEventListener("mousedown", evento => {
        // En este evento solo se ha iniciado el clic, así que dibujamos un punto
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR_PINCEL;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        // Y establecemos la bandera
        haComenzadoDibujo = true;
    });

    $canvas.addEventListener("mousemove", (evento) => {
        if (!haComenzadoDibujo) {
            return;
        }
        // El mouse se está moviendo y el usuario está presionando el botón, así que dibujamos todo

        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR_PINCEL;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
    });
    ["mouseup", "mouseout"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, () => {
            haComenzadoDibujo = false;
        });
    });

    const limpiarCanvas = () => {
        // Colocar color blanco en fondo de canvas
        contexto.fillStyle = COLOR_FONDO;
        contexto.fillRect(0, 0, $canvas.width, $canvas.height);
    };
    limpiarCanvas();
    $btnLimpiar.onclick = limpiarCanvas;
    $btnDescargar.onclick = () => {
        $("#signData").val($canvas.toDataURL());
        alert('Firma Guardada');
    };

    //----------------------------------
    // Captura de foto
    //----------------------------------
    Webcam.set({
        width: 190,
        height: 190,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#myCamera');
    function takeSnapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            document.getElementById('text').innerHTML = '<input type="text" id="image-tag" name="image-tag" value="'+data_uri+'"/>';
        } );
    }
</script>