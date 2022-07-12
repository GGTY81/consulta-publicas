# CIDADES UF

## Consultar cidades de uma UF

Mostra todas as cidades de um determinado estado.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublicas\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $uf = 'RS';
    try {
        $resp = $onsultaPublica->cidadePorEstado($uf);
        if(isset($resp['error'])){
            echo $resp['statusCode']." - ".$resp['error'];
            exit;
        }
        echo "<pre>";
        print_r($resp);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```