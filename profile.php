<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="css/profile.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<form id="cuenta">
<div class="container rounded bg-white mt-5">

    <div class="row">
        <div class="col-md-4 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <i style="margin: 10px;" class="fas fa-credit-card fa-5x"></i>
                <span class="font-weight-bold">Tarjeta</span>
                <input  id="saldo" name="saldo" style="margin-top: 20px;" type="text" class="form-control" placeholder="$0">
                <input style="margin-top: 20px;" id ="action" class="btn btn-primary profile-button"  name ="action" type="submit" value="Agregar Saldo">
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-1 py-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <h6>Datos de tarjeta</h6>
                    </div>
                    <h6 class="mt-5 text-left"> 
                        <button style="margin-top: -40px;" id="salir" class="btn btn-primary profile-button" type="button"> Salir</button>
                    </h6>
                </div>
                <div class="row mt-2">
                    <span style="margin-top: 3px; margin-left: 10px;" class="text-black-50">N° Tarjeta:</span>
                    <div style=" margin-left: 73px;" class="col-md-6"><input type="text" name="noTarjeta" id="noTarjeta" class="form-control" placeholder="first name" value="4455-1251-2515-1055" disabled></div>
                </div>
                <div class="row mt-3">
                    <span style="margin-top: 3px; margin-left: 10px;" class="text-black-50">Fecha de Caducidad:</span>
                    <div class="col-md-6"><input type="text" class="form-control" id="fechaVencimiento" name="fechaVencimiento" placeholder="Email" value="02-21" disabled></div>
                </div>
                <div class="row mt-3">
                    <span style="margin-top: 3px; margin-left: 10px;" class="text-black-50">CVV:</span>
                    <div style="margin-left: 113px;"  class="col-md-6"><input type="text" name="cvv" id="cvv" class="form-control" placeholder="address" value="771" disabled></div>
                </div>
                <div class="row mt-3">
                    <span style="margin-top: 3px; margin-left: 10px;" class="text-black-50">PIN:</span>
                    <div style="margin-left: 118px;" class="col-md-6"><input type="text" name="pin" id="pin" class="form-control" placeholder="Bank Name" value="1452" disabled></div>
                </div>
            </div>
        </div>
   
    </div>
</div>
</form>

<script>
 $(document).ready(function(){
        var cuenta = cuentaLocalStorage();
        if(cuenta == null){
            location.href = 'index.php';
        }
        function cuentaLocalStorage() {
            var cuenta;
            if(localStorage.getItem('cuenta') == null) {
                cuenta = null;
            } else {
                cuenta = localStorage.getItem('cuenta');
                console.log(cuenta);
            }
            return JSON.parse(cuenta);
        }

    $('#noTarjeta').val(cuenta.noTarjeta);
    console.log(cuenta.noTarjeta);
    $('#fechaVencimiento').val(cuenta.fechaVencimiento);
    $('#cvv').val(cuenta.cvv);
    $('#pin').val(cuenta.pin);
    $('#saldo').val(cuenta.saldo);

    $(document).on('submit', '#cuenta',function(e){
        e.preventDefault();
        var obj = {};
            function toJSONString( form ) {
                var elements = form.querySelectorAll( "input, select" );
                for( var i = 0; i < elements.length; ++i ) {
                    var element = elements[i];
                    var name = element.name;
                    var value = element.value;
                    if( name && name!="action") {
                        obj[name] = value;
                    }
                }
                return JSON.stringify(obj);
            }
            var json = toJSONString(this);
            $.ajax({
            url:"http://25.81.215.48:8080/cuenta/actualizar",
            type:"PUT",
            data:json,
            dataType:"json",
            contentType:"application/json",
            success:function(data)
            {
                localStorage.setItem('cuenta', json);
                location.reload();
            }
        });
    });

    $('#salir').click(function(){
        localStorage.removeItem('cuenta');
        loation.reload();
    });

 });
</script>