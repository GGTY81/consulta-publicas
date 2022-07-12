# FERIADOS

## Consultar feriados

Mostra todos os feriados de um determinado ano.

```php
    require_once './consulta-publica/vendor/autoload.php';
    use Divulgueregional\ConsultaPublicas\ConsultaPublica;
    $onsultaPublica =  new ConsultaPublica();

    $ano = 2022;
    try {
        $resp = $onsultaPublica->feriados($ano);

        echo "<pre>";
        print_r($resp);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
```