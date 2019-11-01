<?php 
    $host = 'mysql:host=localhost;dbname=escola;port=3307'; 
    $user = 'root'; 
    $pass = ''; 

    $db = new PDO ($host, $user, $pass); 

    $query = $db -> query ('SELECT * FROM cursos'); 

    $cursos = $query -> fetchAll (PDO::FETCH_ASSOC);

    // var_dump ($cursos);

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
    <form action="cadastroAlunos.php" method = 'post'>
        <h2>Nome aluno</h2>
        <input type="text" name="nomeAluno" id="">
        <h2>RA do Aluno </h2>
        <input type="text" name="raAluno" id="">
        <h2>Cursos</h2>
        <select name="curso" id="">
        <?php foreach ($cursos as $curso): ?>
            <option value="<?= $curso ['id']; ?>"> <?= $curso ['nome']; ?> </option>
            <?php endforeach; ?>
        </select>

        <button type = "submit" > Cadastrar </button>
    </form>
</body>
</html>
