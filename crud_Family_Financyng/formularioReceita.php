<?php
include("config.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Financing</title>
    <link rel="stylesheet" href="css/styleFormularioReceita.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>

    
<?php
    if (isset($_SESSION['status'])) {
        echo "<h4>" . $_SESSION['status'] . "</h4>";
        unset($_SESSION['status']);
    }
?>


    <!-- Formulário de Receita -->
    <div class="form-container" id="form-container">
        <form id="form-receita" action="inserirReceita.php" method="POST">
            <header class="form-header">
                <h2>Receita</h2>
                <button type="button" class="close-btn" id="close-btn">&times;</button>
            </header>

            <!-- Valor -->
            <div class="form-group">
                <label for="valor">Valor</label>
                <div class="valor-input">
                    <span class="currency">R$</span>
                    <input type="number" name="valor" step="0.01" placeholder="0,00" required>
                </div>
            </div>

            <!-- Categoria -->
            <div class="form-group">
                <label for="Categoria">Categoria</label>
                <div class="valor-input">
                    <input type="text"  name="categoria" placeholder="" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-column">
                    <label for="data_registro"><b>Data de Registro</b></label>
                    <input type="date" name="data_registro" id="data_registro" required>
                    </div>
                    <div class="form-column">
                        <label for="numParcelas">Número de Parcelas</label>
                        <input type="number" name="numParcelas" placeholder="Nº de parcelas">
                    </div>
                </div>
            </div>
            <!-- Estado -->
            <div class="form-group">
                <label for="pago">Foi recebido?</label>
                <label class="toggle-switch">
                    <input type="checkbox" name="pago">
                    <span class="switch-slider"></span>
                </label>
            </div>
            <!-- Botões -->
            <div class="form-footer">
                <button type="submit" name="submit" class="submit-btn">Salvar</button>
                <button type="button" class="cancel-btn" id="cancel-btn"> <a
                        href="telaReceita.php">Cancelar</a></button>
            </div>
        </form>
    </div>
   <script src="js/javascriptFormularioReceita.js"></script>
</body>
</html>