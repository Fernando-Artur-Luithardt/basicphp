<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'banco.php';

mysqli_set_charset($conn,"utf-8");

$listausuario = array();
$listatarefa = array();

$sql = "
SELECT usuario.id AS usuario_id, usuario.nome AS usuario_nome
FROM usuario 
ORDER BY usuario.id
";
$resultadosql = mysqli_query($conn, $sql);

while ($arr = mysqli_fetch_array($resultadosql)) {
    
    $usuarioid = (int)$arr["usuario_id"];
    
    if (!array_key_exists($usuarioid, $resultadosql)){
        $usuarionome = $arr["usuario_nome"];
        $listausuario[$usuarioid] = array("id" => $usuarioid, "nome" => $usuarionome);
    }
    
}

$sqltarefa = "
SELECT tarefa.id AS tarefa_id, tarefa.nome AS tarefa_nome, tarefa.id_usuario AS tarefa_usuario
FROM tarefa 
ORDER BY tarefa.id
";

$resultadosqltarefa = mysqli_query($conn, $sqltarefa);

    
while ($arrtarefa = mysqli_fetch_array($resultadosqltarefa)) {
    
    
    $tarefaid = (int)$arrtarefa["tarefa_id"];
    $nome = $arrtarefa["tarefa_nome"];
    $tarefausuario = $arrtarefa["tarefa_usuario"];
    
    $listatarefa[$tarefaid] = array("id" => $tarefaid, "nome" => $nome, "tarefausuario" => $tarefausuario);
        

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de usuario e tarefas</h1>
    <div>
        <table>
                <?php foreach($listausuario as $listuser) { ?>
                    <tr>
                        <td>
                            
                        <?=$listuser["id"]?>   
                        <?=$listuser["nome"]?>
                        
                        <?php foreach($listatarefa as $listata) { 
                            
                                $idusuario =$listuser["id"];
                                $idtarefausuario =$listata["tarefausuario"];
                                
                                if($idtarefausuario == $idusuario){ 
                                    echo $listata["nome"];
                                }
                            }
                        ?>
                                
                            
                        </td>
                    </tr>
                <?php } ?>
                        
        </table>
        
    </div>   
       
</body>
</html>