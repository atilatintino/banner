<?php 
     
     include_once ('config/conexão.php');

     $db = conectarBanco ();

    $query = $db -> query ('SELECT * FROM cursos'); 

    $cursos = $query -> fetchAll (PDO::FETCH_ASSOC);

    if(isset ($_GET ['id'])){
        $id = $_GET ['id']; 
    }else if ($_POST != []){
        $id = $_POST ['id'];
    }else{
        echo "Você deve passar um id"; 
        exit; 
    }

   

    $query = $db -> prepare ('SELECT * FROM alunos WHERE id =? ');
    $query -> execute ([$id]); 

    $aluno = $query -> fetch (PDO:: FETCH_ASSOC);
    //recuperando id do aluno

    if($_POST != []){
        $nomeAluno = $_POST ['nomeAluno'];
        $raAluno = $_POST ['raAluno']; 
        $cursoId = $_POST ['curso']; 
        $id = $_POST ['id'];

        $query = $db->prepare('UPDATE alunos 
        SET nome = :nome, ra = :ra, curso_id = :curso_id 
        WHERE id=:id');
        $query->execute(["nome"=>$nomeAluno,
        "id"=> $id,
        "curso_id"=>$cursoId,    
        "ra"=>$raAluno
        ]);
    }





   /*  var_dump($aluno); */


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="updateAluno.php" method = 'post'>
    <input type="text" name="id" id="" readonly hidden value="<?php echo $id; ?>">
        <h2>Nome aluno</h2>
        <input type="text" name="nomeAluno" id="" value="<?php echo $aluno['nome']; ?>">
        <h2>RA do Aluno </h2>
        <input type="text" name="raAluno" id="" value="<?php echo $aluno['ra']; ?>" readonly>
        <h2>Cursos</h2>
        <select name="curso" id="">
        <?php foreach ($cursos as $curso): ?>

            <?php if($curso['id'] == $aluno['curso_id']):?>
                <option selected value="<?= $curso ['id']; ?>"> <?= $curso['nome']; ?> 
                </option>
            <?php else: ?>
                <option value="<?= $curso ['id']; ?>"> <?= $curso['nome']; ?> 
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
        </select>

        <button type = "submit" > Cadastrar </button>
    </form>
</body>
</html>