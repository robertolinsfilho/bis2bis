<section class="login add">
  <div class="container">
    <section class="box__login create__noticias">

      <div class="result"></div>

      <form action="">
        <h1 class="titulo">Criar Noticia</h1>
        <label for="">Nome</label>
        <input type="text" name="name" placeholder="titulo da noticia">

        <label for="">Texto</label>
        <input type="text"  name="texto" placeholder="texto da noticia">

        <label for="">Imagem</label>
        <input type="url" name="image" placeholder="https://product.png">
        <input type="submit" value="adicionar noticia">
      </form>
    </section>
  </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/createNoticias.js"></script>