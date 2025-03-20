<?php
session_start(); 
include("config.php");

if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)){
    
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  header('Location: telalogin.php');
}
  $logado = $_SESSION['login'];

// Receitas Pendentes
$sql_pendentes = "SELECT SUM(valor) AS total_pendentes FROM receitas WHERE pago = '0'";
$result_pendentes = $pdo->query($sql_pendentes);

$total_pendentes = 0;
if ($result_pendentes->num_rows > 0) {
    $row = $result_pendentes->fetch_assoc();
    $total_pendentes = $row['total_pendentes'] ?: 0;
}

// Receitas Recebidas
$sql_recebidas = "SELECT SUM(valor) AS total_recebidas FROM receitas WHERE pago = '1'";
$result_recebidas = $pdo->query($sql_recebidas);

$total_recebidas = 0;
if ($result_recebidas->num_rows > 0) {
    $row = $result_recebidas->fetch_assoc();
    $total_recebidas = $row['total_recebidas'] ?: 0;
}

// Total Geral
$total_geral = $total_pendentes + $total_recebidas;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Family Financing</title>
  <link rel="stylesheet" href="css/styleTelaReceita.css">
  <link rel="shortcut icon" href="imagem/favicon.ico" type="image/x-icon">
  
</head>
<body>
  <div class="container">
    <!-- Navbar -->
    <nav class="navbar">
      <div class="navbar-left">
        <img src="imagem/logo_Family_Financing.png" alt="Ícone" class="navbar-icon">
        <span class="project-name">Family Financing</span>
      </div>
      <div class="navbar-right">
        <span class="user-name"> <?php echo "Ola, $logado"; ?></span>
        <button class="logout-btn"><a href="telaHome.php">Voltar ao Home</a></button>
      </div>
    </nav>

        <!-- Conteúdo principal -->
    <main class="main-content">
    
      <header class="header">
        <h1>Receitas</h1>
        <button id="nova-receita-btn" class="logout-btn"> <a href="formularioReceita.php"> Nova Receita</a></button>
      </header>

      <!-- Resumo -->
      <!-- Resumo -->
<section class="summary">
    <div class="card">
        <h2>Receitas pendentes</h2>
        <p>R$ <?php echo number_format($total_pendentes, 2, ',', '.'); ?></p>
    </div>
    <div class="card">
        <h2>Receitas recebidas</h2>
        <p>R$ <?php echo number_format($total_recebidas, 2, ',', '.'); ?></p>
    </div>
    <div class="card">
        <h2>Total</h2>
        <p>R$ <?php echo number_format($total_geral, 2, ',', '.'); ?></p>
    </div>
</section>

      <!-- Tabela de despesas com navegação -->
      <section class="despesas">
        <div class="mes-navegacao">
          <button id="mes-anterior" class="nav-btn">◀</button>
          <h2 id="mes-ano">Janeiro 2022</h2>
          <button id="mes-proximo" class="nav-btn">▶</button>
        </div>
        <table>
          <thead>
            <tr>
              <th>Situação</th>
              <th>Data</th>
              <th>Categoria</th>
              <th>Valor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $consulta = "SELECT * FROM receitas";
            $resultado = $pdo->query($consulta);

            while ($linha = mysqli_fetch_assoc($resultado)) {
            
              $status_pago = $linha['pago']; // Exemplo
            
              // Renderizando o ícone
              $icone_status = $status_pago == '1'
                ? '<span style="color: green;">&#x2705;</span>' // Bolinha com verificado
                : '<span style="color: gray;">&#x26AA;</span>';  // Bolinha vazia

            echo "<tr>";
            echo "<td>".$icone_status ."</td>";
            echo "<td>".$linha ["data_registro"] ."</td>";
            echo "<td>".$linha ["categoria"] ."</td>";
            echo "<td>".$linha ["valor"] ."</td>";
            echo "<td> <a href='alterarReceita.php?id=$linha[id]'><img src='imagem/lapis1.jpg' alt='Alterar'></a> &nbsp;&nbsp;
                      <a href='deletReceita.php?id=$linha[id]'><img src='imagem/excluir1.jpg' alt='Deletar'></a>
            </td>";
            
            echo "</tr>";
            }
            ?>

          </tbody>
        </table>
      </section>
    </main>
  </div>
<!-- <script src="js/javascriptTelaReceita.js"></script> -->
</body>
</html>