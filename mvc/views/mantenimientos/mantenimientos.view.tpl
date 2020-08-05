<header>
  <h1 class="title">MANTENIMIENTOS</h1>
</header>

<section class="row">
  {{foreach mantenimientos}}
    <section class="card depth-0 col-3 center">
      <a class="bg-white button" href="index.php?page={{page}}">
        <div class="ion-{{ionicon}} bigicon"></div>
        <div class="desc">{{pageDsc}}</div>
      </a>
    </section>
  {{endfor mantenimientos}}
</section>

<style>
  .button{
    display: block;
    overflow: auto;
    padding: 1em;
    text-decoration: none;
  }
  .title{
    color: rgb(147, 207, 69);

  }

  .bigicon {
    font-size: 3em;
    color: #20a170;
  }

  .desc{
    color: #024b29;
  }

  a.bg-white:hover{
    background-color: #b9b9b9 !important;
  }
</style>