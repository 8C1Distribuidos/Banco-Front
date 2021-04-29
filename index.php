<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="css/login.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="fontawesome-free-5.15.3-web/css/all.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h1>BANCO</h1>    <!-- Icon -->
    <div class="fadeIn first">
    <i style="margin: 10px;" class="fas fa-piggy-bank fa-7x"></i>
    </div>

    <!-- Login Form -->
    <form id ="login" method="post">
      <input type="text" id="card" name="noTarjeta" class="fadeIn second" name="noTarjeta" maxlength="16" placeholder="No. de tarjeta" required>
      <input type="text" id="pin" name="pin" class="fadeIn third" name="pin" placeholder="****" required>
      <div id="alerta">
      </div>
      <input type="submit" name="action" class="fadeIn fourth" value="Iniciar">
    </form>

  </div>
</div>
<script>
 $(document).ready(function(){
$(document).on('submit', '#login',function(e){
  e.preventDefault();
  var obj = {};
  function toJSONString( form ) {
    var elements = form.querySelectorAll( "input, select" );
    var ident=Math.floor(Math.random() * 999999);
    for( var i = 0; i < elements.length; ++i ) {
      var element = elements[i];
      var name = element.name;
      var value = element.value;
      console.log(name);
      if( name && name!="action") {
        obj[name] = value;
        console.log(obj);
      }
    }
    console.log(obj);
    return JSON.stringify(obj);
  }
  var json = toJSONString( this );
        //POST
        console.log(json);
        $.ajax({
            url:"http://25.81.215.48:8080/cuenta/datos",
            type:"POST",
            data:json,
            dataType:"json",
            contentType:"application/json",
            success:function(data)
            {
              if(data!=null){
                localStorage.setItem('cuenta', JSON.stringify(data));
                console.log(data);
                location.href = "profile.php"
              }else{
                $("#alerta").html("");
                var alerta = "<div class='alert alert-danger' id ='alert' role='alert'>Credenciales incorrectas</div>";
                $("#alerta").append(alerta);
              }
            }
        });

});

});
</script>