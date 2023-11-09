


<?php


    $codigo = $_POST['codigo'];
    $host = '127.0.0.1';
    $port = '25003';
    $i = 0;


    //Información del grabador
    $nvr_puerto = '25003';
    $nvr_ip = '192.168.100.129';
    //Información de la conexión
    $tiempo = 30;

    while($i<1){
        $message = $codigo;
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die ("No se pudo crear el socket");
        $result = socket_connect($socket, $host, $port) or die ("No se pudo conectar al servidor web");
        socket_write($socket, $message, strlen($message)) or die ("No se pudo enviar los datos al servidor");

        $result = socket_read($socket, 1024) or die("No se puede leer la respuesta del servidor");



        echo $result . "\n";
        socket_close($socket);

        
        //Se establece una conexión al NVR mediante TCP
        $conexion = fsockopen($nvr_ip, $nvr_puerto, $errno, $errstr, $tiempo);

        if (!$conexion) {
            //Si no hay conexión, imprime el error.
            echo "$errstr ($errno)<br />\n";
        }else{
            
            $datos .= "---EJEMPLO DE MENSAJE---:";
            $datos .= "Mensaje recibido: $message\r\n";
            $datos .= "---------------------------------------\r\n";
        
            //Se envían los datos al NVR
            fwrite($conexion, $datos);
        
            //Se cierra la conexión TCP con el grabador
            fclose($conexion);
        
            echo "OK";
        }


        $i++;
     

    }

    
?>