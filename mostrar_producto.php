<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	
	<style>
	
        img{
			position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
			max-width: 100%;
			height: auto;
		}
		
		h1{
			font-family: arial;
			font-size: 40px;
		}
		
		p{
			color: green;
			font-family: arial;
			font-size: 60px;
		}
		
		#noencontrada{
			max-width: 50%;
			height: auto;
		}
		
    </style>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 2000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
</head>
<body>
  
  <h1 style='text-align: center'>
	
    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
			  echo "<p style='text-align: center'>Producto Encontrado</p><br>";
			
              echo "Producto: ".$result["producto_nombre"]."<br>";
              echo "Precio: ".$result["producto_precio"]."<br>";
              echo "Stock: ".$result["producto_cantidad"]."<br>";
              echo "<img src='".$result["producto_imagen"]."' width='150px' height='150px'>";
			  
            }
            else{
              echo "No se encuentra el producto <br>";
              echo "<img id='noencontrada' src='img/error.png' alt='' width='20%' height='20%'>";
            }
            
            
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>