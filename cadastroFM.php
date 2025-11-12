<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>CadastroCP</title>
<style>
  body, html {
    margin: 0; padding: 0; height: 100%;
    font-family: Arial, sans-serif;
    background: url('fundo.png') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .container {
    width: 900px;
    height: 500px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    display: flex;
    overflow: hidden;
    flex-direction: row-reverse;
  }
  .imagens {
    flex: 1;
    position: relative;
  }
  .imagens img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
    transition: opacity 1s ease-in-out;
    position: absolute;
    top: 0; left: 0;
  }
  .login {
    flex: 1;
    padding: 40px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  h2 {
    margin-bottom: 24px;
    color: #333;
    font-weight: bold;
    text-align: center;
  }
  form {
    display: flex;
    flex-direction: column;
    margin-bottom: 40px;
  }
  input {
    margin-bottom: 15px;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
  }
  button {
    text-decoration: none;
    margin-top: 5px;
    padding: 10px 30px;
    font-size: 1.2em;
    background-color: rgba(23, 40, 199, 0.59);
    border: none;
    color: rgb(255, 255, 255);
    cursor: pointer;
    border-radius: 30px;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #3771aaff;
  }
  .form-title {
    margin-bottom: 12px;
  }
</style>
</head>
<body>
<div class="container">
  <div class="imagens">
    <img src="https://paliativo.org.br/wp-content/uploads/2021/11/social-worker-taking-care-old-woman-scaled-e1637170958262.jpg" alt="Cuidador" style="opacity: 1">
    <img src="https://institutolg.com.br/wp-content/uploads/2023/01/cuidados-paliativos-oncologia-1024x576.jpeg" alt="Cuidado ao Idoso" style="opacity: 0">
    <img src="https://escoladesaude.saobernardo.sp.gov.br/wp-content/uploads/2021/07/sbc_cursos_lcmi_profissionais_profissional_Cuidados-Paliativos-em-Neonatologia-e-Pediatria.jpg" alt="Assistência" style="opacity: 0">
  </div>
  <div class="login">
<h2>Cadastro de Cuidador</h2>
<form method="post" action="cadastrofamiliar.php">
    <input type="hidden" name="action" value="cadastro"/>
    <input type="text" name="nome" placeholder="Nome" required/>
    <input type="email" name="email" placeholder="Email" required/>
    <input type="text" name="cpf" placeholder="CPF" required/>
    <input type="password" name="senha" placeholder="Senha" required/>
    <input type="text" name="telefone" placeholder="Telefone" required/>
    <button type="submit">Cadastrar</button>
</form>
</div>

<script>
  let imagens = document.querySelectorAll('.imagens img');
  let atual = 0;
  setInterval(() => {
    imagens[atual].style.opacity = 0;
    atual = (atual + 1) % imagens.length;
    imagens[atual].style.opacity = 1;
  }, 5000);
</script>

</body>
</html>