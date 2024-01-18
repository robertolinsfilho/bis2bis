<section class="login edit__noticias">
  <div class="container">
    <section class="box__login">

      <div class="result"></div>

      <form action="">
        <label for="">Nome</label>
        <input type="text" name="name" placeholder="titulo da noticia" value="<?php echo $noticias['name']; ?>">

        <label for="">Texto</label>
        <input type="text"  name="texto" placeholder="Texto da noticia" value="<?php echo $noticias['texto']; ?>">

        <label for="">Image</label>
        <input type="url" name="image" placeholder="https://product.png" value="<?php echo $noticias['image']; ?>">

        <input type="hidden" name="id" value="<?php echo $noticias['id']; ?>">
        
        <input type="submit" value="Atualizar noticia">
      </form>
    </section>
  </div>
</section>

<script src="<?php echo BASE_URL; ?>app/public/js/editNoticias.js"></script>