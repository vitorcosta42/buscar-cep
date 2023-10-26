<h1><a href="https://github.com/vitorcosta42/buscar-cep">Consulta de CEP - Vitor Costa </a></h1>

<div style="display: inline_block">
   <img src="https://img.shields.io/badge/PHP-darkgreen"/>
   <img src="https://img.shields.io/badge/Laravel-darkgreen"/>
    <img src="https://img.shields.io/badge/Vue.js-darkgreen"/>
    <img src="https://img.shields.io/badge/Bootstrap-darkgreen"/>
    <img src="https://img.shields.io/badge/MySQL-darkgreen"/>
    <img src="https://img.shields.io/badge/Docker-darkgreen"/>
</div>
<img width="1000" src= "./public/home.png" />

<h2>Descrição</h2>
<p>
  Projeto Full-Stack utilizando Vue.js e Bootstrap para o Front-end, e PHP, Laravel, Docker e MySQL para o back-end. Além disso, temos o consumo da API do ViaCEP para a busca de dados, de forma que o registro de endereços se torne mais dinâmico para o usuário. Temos validação, criação, edição, listagem e remoção de endereços, em um excelente projeto de aprendizado do consumo de API's no back-end e também do uso da containerização do Docker para deixar a criação e a utilização dos projetos muito mais fácil e rápida.
</p>

<h2>Como utilizar</h2>

<h3>1. Clone o repositório:</h3>
<pre>
  <code>
    git clone https://github.com/vitorcosta42/buscar-cep.git
  </code>
</pre>

<h3>2. Entre no repositório clonado e instale as dependências:</h3>
<pre>
  <code>
    npm install
  </code>
</pre>
<pre>
  <code>
    composer install
  </code>
</pre>

<h3>3. Configure seu arquivo .env usando o .env.example como base. Exemplo: </h3>
<pre>
     <img src="./public/env.png" width="500" alt="Foto de Vitor Costa"/>
</pre>



<h3>3. Inicie os containers Docker usando Laravel Sail</h3>
<h4> <a href="https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository">Lembre-se de ter o Docker instalado na sua máquina!</a></h4>
<pre>
  <code>
    ./vendor/bin/sail up -d
  </code>
</pre>
<h3>4. Faça as migrações</h3>
<pre>
  <code>
    ./vendor/bin/sail artisan migrate    
  </code>
</pre>
<h3>5. Inicie o servidor Vue da aplicação </h3>
<pre>
  <code>
    npm run dev   
  </code>
</pre>
<h6>Após realizar esta sequência de passos a aplicação já estará pronta para ser utilizada, se seguiu o .env de exemplo à risca, ela poderá ser acessada em <a href="http://localhost:8000/" >http://localhost:8000/</a> </h6>
<h2>Créditos</h2>
<table>
  <tr>
    <td align="center">
      <a href="https://github.com/vitorcosta42">
        <img src="./public/icon-vitor.jpeg" width="100px;" alt="Foto de Vitor Costa"/><br>
        <sub>
          <b>Vitor Costa</b>
        </sub>
      </a>
    </td>
  </tr>
</table>

<h2>Licença</h2>
<b>All Rights Reserved</b>
