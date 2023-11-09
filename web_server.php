<?php

    set_time_limit(0);

    $host = '192.168.100.129';
    $port = '25003';
    $socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
    
    socket_bind($socket, $host, $port) or die ('Error al vincular socket con IP en este cliente');
    echo socket_strerror(socket_last_error());
    socket_listen($socket);

    $i = 0;

    while(true){
        echo "\n";
        $client[++$i] = socket_accept($socket);
        $message = socket_read($client[$i], 1024);
        echo $message . "\n";
        $message = "Paquete recibido: ". $message . "\n";
        echo "\n";
        socket_write($client[$i], $message . "\n\r", 1024);
        socket_close($client[$i]);
    }
    socket_close($socket);
?>