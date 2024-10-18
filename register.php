<?php require_once "header.php" ?>




<div class="ui vertical stripe segment">
    <div class="ui grid container">
 

<?php 
$conn = Container::getBanco();
if (!empty($_POST)){
      if( array_key_exists('turma', $_POST ) == 1 and 
          //array_key_exists('periodo', $_POST ) == 1 and
           array_key_exists('cei', $_POST ) == 1  and 
           array_key_exists('nome', $_POST ) == 1  and 
           (array_key_exists('email', $_POST ) == 1  or 
           array_key_exists('telefone', $_POST ) == 1    ) ){
          $nome = $_POST["nome"];
          $sobrenome = $_POST["sobrenome"]; 
          $turma = $_POST["turma"];
          $cei =  $_POST["cei"];
          $cpf = $_POST["cpf"];
          $data_nasc = $_POST["data_nasc"];
         // echo $data_nasc;
          $email = $_POST["email"];
          $nome_resposanvel = $_POST["nome_responsavel"];
          //$periodo = $_POST["periodo"];
          $periodo = "";
      if (!empty($nome) and !empty($sobrenome) and !empty($turma) and !empty($cei) and  !empty($cpf)) {
          $crianca1 = new Crianca;
          $crianca1->setNome($nome)->setSobrenome($sobrenome)->setTurma($turma)->setCei($cei)->
          setCpf($cpf)->setDataNasc($data_nasc)->setEmail($email)->setNomeResponsavel($nome_resposanvel)->
          setPeriodo($periodo)->setCodigoGerar();
          $crianca = new CrudCrianca($conn, $crianca1);
          $id = $crianca->save();
        }
      }else {
    $erro = 1;
  }
}
?>
                       
                           <?php   if  (!empty($id)) {?>
                            <div class="ui message success">
                              <div class="header">
                              Cadastro realizado com sucesso.
                              </div>
                              <ul class="list">
                                <p class="">Por segurança e para manter a privacidade da sua criança, o nome de nenhuma criança consta na lista de espera pública. 
                                                          Para identificar a posição da sua criança procure pelo código <span class="negrito"> <?php echo $crianca1->getCodigo();?> 
                                                  
                                 <a href="/">Clique aqui para consultar a lista</a>
                              </ul>
                            </div>
                            <?php   } else { if (!empty($erro)){?>

                              <div class="ui message danger">
                              <div class="header">
                              Cadastro realizado com sucesso.
                              </div>
                              <ul class="list">
                              <p class="">Dados Obrigatorios Ficaram Falatando, Por favor preencha todos os campos. </span>

                              </ul>
                            </div>
                          
                           <?php  }
                          }?>




<form class="ui form" action="register.php" method="POST">
<h3 class="ui dividing header">Cadastro Na Lista de Transferência</h4>
  <div class="field">
    <label>Name</label>
    <div class="two fields">
      <div class="field">
        <input type="text"  name="nome" placeholder="Nome da Criança" required>
      </div>
      <div class="field">
        <input type="text"  name="sobrenome" placeholder="Sobrenome da Criança" required>
      </div>
    </div>
  </div>
 
  <div class="field">
    
    <div class="two fields">
      <div class="field">
      <label>Data Nascimento</label>
        <input type="Date"   name="data_nasc"   oninput="mascaradata(this)" 
                                        placeholder="Data de Nascimento" required>
      </div>
      <div class="field">
      <label>CPF</label>
        <input type="text"  name="cpf" oninput="mascara(this)" 
                                         
                required title="O formato do seu CPF está incorreto. Por favor, corriga seguindo o padrão com os pontos e traços."
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"  minlength="14"   maxlength="14"    placeholder="CPF da Criança" required>
      </div>
    </div>
  </div>                  
  <div class="field">
    <label>Responsavel</label>
    <div class="two fields">     

      <div class="field">
        <input type="text"   name="nome_responsavel"   oninput="mascaradata(this)" 
                                        placeholder="Nome do Responsavel" required>
      </div>
      <div class="field">
      <div class="ui checkbox ">
              <input type="checkbox" name="permitir[]" value="1" id="permitir"   title="Desculpa, mas se o compartilhamento dos dados não podemos adicionar a criança a lista de espera." required oninvalid="this.setCustomValidity(\'Desculpa, mas se o compartilhamento dos dados não podemos adicionar a criança a lista de espera\')">
              <label for="permitir" >Se você (o responsavel pela criança) permite o compartilhamento dos seus dados e dos dados da criança com a Prefeitura Municpal de Araquari, marque essa opção. </label>
            </div>
      </div>       </div>
   
  </div>                              

  <div class="field">
    <label>Endereço</label>
      <div class="field">
          <input type="text"   name="email"  placeholder="Endereço" >
      </div>
  </div>       
  
  
  <hr class="ui dividing header"> 

  <div class="field" id="turma" >
    <!--<div class="two fields">
        <div class=" field">-->
            <label>Turma em deseja vaga*</label>
            <div class="two fields">
              <div class=" field">
                  <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="5" id="turma1">
                    <label  for="turma1" > Berçário 1 (01/04/2024 a 31/03/2025)</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="1" id="turma2">
                    <label  for="turma2" > Berçário 2 (01/04/2023 a 31/03/2024) </label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="2" id="turma3">
                    <label  for="turma3"> Maternal (01/04/2022 a 31/03/2023)</label>
                </div>
              </div>
              <div class=" field">
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="3" id="turma4">
                    <label  for="turma4">Jardim (01/04/2021 a 31/03/2022)</label>
                </div>
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="4" id="turma5">
                    <label  for="turma5"> Pré  1 (01/04/2020 a 31/03/2021)</label>
                </div> 
                <div class="ui radio checkbox">
                    <input type="radio" name="turma" value="6" id="turma6">
                    <label  for="turma6"> Pré  2 (01/04/2019 a 31/03/2020)</label>
                </div>
              </div> 
             <!-- </div> 
              </div> -->
            <!--<div class="field">
              <label >Período Desejado*</label>
              <div class="ui relaxed divided list">
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="periodo[]" value="1" id="periodo1">
                    <label for="periodo1" >Matutino</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="periodo[]" value="2" id="periodo2">
                    <label for="periodo2" >Vespertino</label>
                  </div>
                </div>-->
              <!--<div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="periodo[]" value="3" id="periodo3">
                  <label for="periodo3">Integral</label>
                </div>
              </div>-->
            <!--</div>
          </div>-->
        </div>
 
 
    
    <hr class="ui dividing header">                           

  <div class="field" id="turma" >
    <label>CEIs Desejados</label>
    <div class="two fields">
      <div class="field">
        <div class="two fields">
          <div class="field">
            <div class="ui relaxed divided list">
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox"  name="cei[]" id="cei2" value="1">
                  <label for="cei2" > Antenor Sprotte - Centro </label>
                </div>
              </div>
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="cei[]" id="cei3"   value="2">
                  <label for="cei3" >Branca de Neve - Itinga (próx. Mercado Albino) </label>
                </div>
              </div>
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="cei[]"  id="cei4"  value="3" >
                  <label for="cei4">Bruno de Magalhães - Itinga (próx. Paróquia São Luiz Gonzaga) </label>
                </div>
              </div>
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="cei[]"  id="cei5"   value="4" >
                  <label for="cei5">Cantinho da Vovó Justina - Itinga (próx. Hipermais)</label>
                </div>
              </div>
              <div class="item">
                <div class="ui checkbox ">
                  <input type="checkbox" name="cei[]"   id="cei6"  value="5">
                  <label for="cei6">Cinderela - Centro </label>
                </div>
              </div>
            </div>
          </div>
          <div class=" field">
            <div class="ui relaxed divided list">
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"  id="cei7"  value="6" >
                    <label for="cei7" >Criança Bela - Itinga (próx. restaurante Gil)</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"  id="cei8"  value="7">
                    <label for="cei8" >Heley de Abreu - Itinga (próx. Escola Cauã)</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"  id="cei9"  value="8">
                    <label for="cei9">João Geraldo Correa - Itapocu</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"  id="cei10"   value="9" >
                    <label for="cei10">João Ignácio Filho - Rainha</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"  id="cei12"  value="11" >
                    <label for="cei12">João Luiz do Rosário - Corveta</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      <div class="field">
        <div class="two fields">
          <div class="field">
            <div class="ui relaxed divided list">
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]"   id="cei13"  value="12">
                    <label for="cei13" >João Serafim -Barra do Itapocu</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei14"  value="13">
                    <label for="cei14" >Lindolpho José da Silva - Porto Grande</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei15"  value="14">
                    <label for="cei15">Pequeno Anjo - Casa Nova</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox"name="cei[]" id="cei16"  value="15"   >
                    <label for="cei16">Pequeno Principe - Areias Pequenas</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei17"  value="16">
                    <label for="cei17">Professora Janaina - Itinga (próx. Escola Cauã)</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei18"  value="17">
                    <label for="cei18" >Marise Travasso - Itinga (próx. Escola Jablonsky)</label>
                  </div>
                </div>
              </div>
            </div>
          
          <div class="field">
            <div class="ui relaxed divided list">
                
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei19"  value="18">
                    <label for="cei19" >Santo Antônio - Itinga (próx. Campo do Perna)</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei20"  value="19">
                    <label for="cei20"> Vovó Brandina - Centro</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei21" value="20" >
                    <label for="cei21"> Vovó Maria de Lurdes Max - Icaraí (próx. IFC)</label>
                  </div>
                </div>
                <div class="item">
                  <div class="ui checkbox ">
                    <input type="checkbox" name="cei[]" id="cei22" value="21" >
                    <label for="cei22"> Andreia Alexandra Venâncio Borba (próx. Meimei)</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>                        
                       
                        <div class="ui buttons fluid">
                                <a  class="ui button secondary " href="/">
                                   Cancelar
                                </a>
                                <button type="submit" class="ui button ">
                                   Salvar
                                </button>
                        </div>
                              
                            </form>
                        </div>
                        </div>
                        
                            
              
        <?php require_once "footer.php" ?>
