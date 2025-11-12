<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['botaoCuidador'])) {
        header('Location: loginCP.php');
        exit();
    }
    if (isset($_POST['botaoCliente'])) {
        header('Location: loginFM.php');
        exit();
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Capa do Site</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Nunito', sans-serif;
            color: #333;
        }



        
        .capa {
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
                        url('cuidado.png') center/cover no-repeat;
            height: calc(120vh - 90px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 20px;
        }



        .capa h1 {
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .capa p {
            font-size: 1.4em;
            max-width: 600px;
            line-height: 1.5;
            margin-bottom: 40px;
        }

        .botoes {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .botao {
            padding: 15px 35px;
            font-size: 1.2em;
            border: none;
            border-radius: 30px;
            background: #ffffffcc;
            color: #2c5c54;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 200px;
        }

        .botao:hover {
            background: #3d746b;
            color: #fff;
            transform: translateY(-2px);
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #2c5c54;
            color: white;
            font-size: 0.95em;
            letter-spacing: 0.5px;
        }
        nav {
           background: linear-gradient(90deg, #3d746b, #2c5c54);
            padding: 10px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        nav .logo img {
            height: 70px;
            width: auto;
        }

        nav ul { 
            display: flex;
            list-style: none;
        }

        nav li {
            margin-left: 10px;  
        }

        nav li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }

        nav li a:hover{
            background-color: #cdebd5ff;
        } 

            .capa h1 {
                font-size: 2.2em;
            }

            .capa p {
                font-size: 1.1em;
            }

            .botao {
                font-size: 1em;
                padding: 12px 25px;
            }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="index.php">
                <img src="logo1.png" alt="Logo - Cuidados Paliativos" loading="lazy">
            </a>
        </div>
        <ul>
            <li><a href="Sobre-Site.html">Sobre o Site</a></li>
            <li><a href="Sobre-Cuidado-Paliativo.html">Conceito</a></li>
            <li><a href="Equipe-Multidisciplinar.html">Equipe Multidisciplinar</a></li>
        </ul>
    </nav>

    <div class="capa">
        <h1>Bem-vindo</h1>
        <p>Conectamos cuidadores e famílias com empatia e profissionalismo.</p>
        
        <div class="botoes">
            <form method="post">
                <button class="botao" type="submit" name="botaoCuidador">Sou Cuidador</button>
            </form>

            <form method="post">
                <button class="botao" type="submit" name="botaoCliente">Sou Cliente</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; 2025 - Pedro Francisco Lopes Parsianelo
    </footer>
</body>
</html>
