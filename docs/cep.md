# CONSULTAR CEP

## Como consultar um cep

Você poderá escolher em qual opção queira consultar e depois tratar o retorno conforme quiser.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublica\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $cep = "55324-424";//pode ser só número ou em formato de cep
    $opcao = 1;//1-viacep.com.br; 2-cep.awesomeapi.com.br; 3-brasilapi.com.br
    try {
        $consultarCEP = $onsultaPublica->consultarCEP($cep, $opcao);
        echo "<pre>";
        print_r($consultarCEP);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```

## Como validar o cep

Para validar só segui os passos abaixo.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublica\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $cep = "55324-424";//pode ser só número ou em formato de cep
    $validarCEP = $onsultaPublica->validarCEP($cep);
    if($validarCEP){
        echo "CEP Válido";
    }else{
        echo "CEP Inválido";
    }
```