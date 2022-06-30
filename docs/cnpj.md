# CONSULTAR CNPJ

## Como consultar um cnpj

Você poderá escolher em qual opção queira consultar e depois tratar o retorno conforme quiser.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublicas\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $cnpj = '11.444.777/0001-61';//pode ser só número ou em formato de cnpj
    $opcao = 2;//1-publica.cnpj.ws; 2-receitaws (3 consultas por minuto); 3-speedio(50 requisição dia); 4-minhareceita; 5-eanpictures; 6-brasilapi
    try {
        $consultaCNPJ = $onsultaPublica->consultaCNPJ($cnpj, $opcao);
        echo "<pre>";
        print_r($consultaCNPJ);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```

## Como validar o cnpj

Para validar só segui os passos abaixo.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublicas\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $cnpj = '11.444.777/0001-61';//pode ser só número ou em formato de cnpj
    try {
        $validarCNPJ = $onsultaPublica->validarCNPJ($cnpj);
        if($validarCNPJ){
            echo "CNPJ Válido";
        }else{
            echo "CNPJ Inválido";
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```

## Formato personalisado, meu uso

Formatei para meu uso próprio para a minha aplicação.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublicas\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $cnpj = '11.444.777/0001-61';//pode ser só número ou em formato de cnpj
    try {
        $consultarCNPJ = $onsultaPublica->consultarCNPJ($cnpj);
        echo "<pre>";
        print_r($consultarCNPJ);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```