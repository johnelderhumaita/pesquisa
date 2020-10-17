
<?php include('../header.php') ?>
<?php include('../menu.php') ?>


<?php 
    include("../conec/conexao.php");

    $consulta = "
                      SELECT DISTINCT *
                      FROM produtos
                      ORDER BY id DESC
                 ";

    $con = $mysqli->query($consulta) or die($mysqli->error); 
?>



<script type="text/javascript">
$(document).ready(function(){
  $("#listSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


<br>

<!--====PESQUISA====-->
  <div class="container-fluid px-lg-5"><!--CONTEUDO-->

<div class="collapse.show" id="collapseExample">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    FECHAR ANÚNCIO
  </button>
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>
<br>
  <input class="form-control" id="listSearch" type="text" placeholder="Pesquise aqui">
  </div>
 <!--PESQUISA-->

  <!-- Button trigger modal -->
<div class="container-fluid px-lg-5">
  <div class="row">
    <div class="cart-total container-fluid text-center">
   <!--     <button class="card btn btn-primary modal-header mx-auto" type="button" data-toggle="modal" data-target="#exampleModal">
        <span>Ver lista de compras </span>
      </button>  -->

        <h6 class="cart-total-title"><span>Total</span> 
         <strong class="cart-total-price">R$ 0</strong>
        </h6> 
   </div>
  </div>
</div>
<p></p>

  <?php while($mostrar = $con->fetch_array()){ ?>

<ul class="container-fluid px-lg-5" id="myList"><!--PRODUTOS-->

      <li class="list-group-item container-fluid card-footer bg-transparent card-body "><!--LISTA PRODUTOS-->

            <a class="btn container-fluid blue-gradient">               
              <span class="shop-item-nome text-white  float-none font-weight-bold"><?php echo $mostrar["nome"] ?></span><!--Loja-->
            </a>

              <span class="btn  card container-fluid p-3 mb-2 bg-white"><!--CARD DESCRIÇÃO / IMAGEM / NOME PRODUTO-->
                  <h6>
                       <span class="shop-item-nomeproduto font-weight-bold"><?php echo $mostrar["nomeproduto"] ?></span><!--NOMEPRODUTO-->
                  </h6>
                          <strong><p class="text-muted">Descrição:</p></strong> 
                      <span class="shop-item-descricao float-none"><?php echo $mostrar["descricao"] ?></span><!--DESCRIÇÃO-->
              </span>
   
              <span class="btn  card container-fluid p-3 mb-2 bg-white font-weight-bold shop-item-button">
                  <span class="preco"><!--<i class="fas fa-cart-arrow-down"></i>--> R$ 
               <span class="shop-item-price text-black float-none"><?php echo number_format($mostrar["preco"],2,",",".")  ?> </span><!--PREÇO-->
               <!-- <?php echo number_format($mostrar["preco"],2,",",".")  ?> -->
               
            </span>
      </li>

</ul>
<?php } ?>    
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
     
      <div class="modal-body">
               <ul class="container-fluid px-lg-5">
              <footer class="fixed t">
                <div class="container-fluid px-lg-5">
                

                 <center>      
                        <a class="btn card btn-primary blue-gradient text-center" data-toggle="collapse show" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Lista de compras</a>
                </center>
                      <div class="collapse show" id="collapseExample">
                            <div class="cart-items"></div>
                      </div>
              </div>

                 <div class="cart-total container-fluid text-center">
                    <h6 class="cart-total-title">Total 
                     <strong class="cart-total-price">R$ 0</strong></h6>
              </div>
              </footer>
          </ul>
      </div>
      <div class="modal-footer mx-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
<!--         <button type="button" class="btn btn-primary">Salvar lista</button> -->
      </div>
    </div>
  </div>
</div>

