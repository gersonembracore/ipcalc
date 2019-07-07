<?php 

  /*
    Instituto Federal Catarinense
    Disciplinas:  Programação Orientada a Objetos
                  Fundamentos de redes de computadores
    Data:         06 de julho de 2019

    @author:      Gerson Pereira 
                  Matheus Victor Araújo Fereira 
                  Matheus Henrique Zimpel Paiano
 
    Finalidade:   Receber endereço IP e máscara em Bits para calcular endereço de rede

  */


	require_once('IpCalc.php');
  

	if(		isset($_POST['ip']) && 
			isset($_POST['masc'])) 
		{
			$calc1 = new IpCalc
				(
					$_POST['ip'],
					$_POST['masc']
				);
       
        $calc1 = new IpCalc();
        $calc1->setIpDec($_POST['ip']);
        $calc1->setMskBit($_POST['masc']);

        $calc1->calculaNw();

        $arrayResultados = array(

          "IP Decimal"   => $calc1->getIpDec() ,
          "Msk Decimal"  => $calc1->getMskDec() ,
          "Nw Decimal"   => $calc1->getNwDec(),
          "Brd Decimal"  => $calc1->getBrdDec(),
          "Qtde Hosts"   => $calc1->getQtdeHosts(),
          "Hosts+Nw+Brd" => $calc1->getQtdeHostsIncludeNwBrd(),

          "Ip Bin"       => $calc1->getIpBin() ,
          "Msk Bin"      => $calc1->getMskBin(),
          "Nw Bin"       => $calc1->getNwBin(),
          "Nw Inversa"   => $calc1->getMskBinInversa(),
          "Brd Bin"      => $calc1->getBrdBin()
        );
         


		}

 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Calculadora IP</title>
  </head>
  <body>
   	<div class="container">
   		<div class="row justify-content-center" style="margin-top: 10%;">
   			<div class="col-sm-6">
	   			<div class="card">
		   			<div class="card-header">Cálculo com base no IP e Máscara</div>
		   			<div class="card-body">
		   				<form action="#" class="form" method="POST">
		   					<div class="form-group">
		   						<label>Endereço IP</label>
		   						<input type="text" name="ip" class="form-control">
		   					</div>
		   					<div class="form-group">
		   						<label for="">Máscara</label>
		   						<select name="masc" id="" class="form-control">
                    <option value="24">24</option>
		   							<?php 
     										for ($i=8; $i < 33; $i++) { 
     											echo "<option value=".$i.">".$i."</option>";     											
     										}                     					 
		   							 ?>                     				
                	</select>
		   					</div>

		   					<button type="submit" class="btn btn-success"> <i class="fa fa-paper-plane"></i> Calcular</button>
							  <button type="reset" class="btn btn-primary"> <i class="fa fa-trash"></i> Limpar Formulário</button>
		   				</form>
		   			</div>
	   			</div>
   			</div>

         <div class="card">
          <div class="card-header">
            Resultado
            <a href="index.php" class="btn btn-primary ml-5"> <i class="fa fa-home"></i> Voltar para o menu</a>
          </div>
          <div class="card-body">
            <?php
              // exibir resultado
                if (isset($arrayResultados)) {
                 
                    foreach ($arrayResultados as $key => $resultado) {
                      echo "<b>$key: </b>" . $resultado."<br>";
                    }



                }   else {
                  echo "Entre com o IP e a Máscara";
                }                    
               


            ?>
          </div>
         </div>
   		</div>
   	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


