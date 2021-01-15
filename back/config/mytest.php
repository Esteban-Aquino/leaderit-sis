<?php
    require 'db.php';

try {
    
    
    $conn = new PDO(
                'mysql:dbname=' . DATABASE .
                ';host=' . HOSTNAME .
                ';port:63343;',
                USERNAME,
                PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
   $stmt = $conn->query("select * from test");
   $stmt->execute();
    while ($row = $stmt->fetch()) {
        print_r($row['test']."<BR>");
    }
    IF ($conn === null){
        echo("Error al conectar");

    }else{
        echo "Conectado!!";
    }
} catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
}

?>

