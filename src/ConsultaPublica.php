<?php
namespace Divulgueregional\ConsultaPublicas;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use stdClass;

class ConsultaPublica{
    function __construct()
    {
    }

    public function consultarCNPJ(string $cnpj){
        if($this->validarCNPJ($cnpj)){
            return $this->publicacnpjws($cnpj, 1);
        }else{
            return "CNPJ Inválido";
        }
    }
    
    private function publicacnpjws($cnpj, $personalisado=''){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->clientConsultaCNPJ = new Client([
            'base_uri' => 'https://publica.cnpj.ws',
        ]);

        try {
            $response = $this->clientConsultaCNPJ->request(
                'GET',
                "/cnpj/{$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            if($personalisado==''){
                return json_decode($response->getBody()->getContents());
            }else{
                return $this->dadosCNPJ(json_decode($response->getBody()->getContents()));
            }
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    public function consultaCNPJ(string $cnpj, int $opcao=1){
        if($this->validarCNPJ($cnpj)){
            if($opcao==1){
                return $this->publicacnpjws($cnpj);
            }elseif($opcao==2){
                return $this->receitaws($cnpj);
            }elseif($opcao==3){
                return $this->speedio($cnpj);
            }elseif($opcao==4){
                return $this->minhareceita($cnpj);
            }elseif($opcao==5){
                return $this->eanpictures($cnpj);
            }elseif($opcao==6){
                return $this->brasilapicnpj($cnpj);
            }
        }else{
            return "CNPJ Inválido";
        }
    }

    private function receitaws($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->clientConsultaCNPJ = new Client([
            'base_uri' => 'https://www.receitaws.com.br',
        ]);

        try {
            $response = $this->clientConsultaCNPJ->request(
                'GET',
                "/v1/cnpj/{$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    private function speedio($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->clientspeedio = new Client([
            'base_uri' => 'https://api-publica.speedio.com.br',
        ]);

        try {
            $response = $this->clientspeedio->request(
                'GET',
                "/buscarcnpj?cnpj={$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    private function minhareceita($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->clientminhareceita = new Client([
            'base_uri' => 'https://minhareceita.org',
        ]);

        try {
            $response = $this->clientminhareceita->request(
                'GET',
                "/{$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    private function eanpictures($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->clienteanpictures = new Client([
            'base_uri' => 'http://eanpictures.com.br:8000',
        ]);

        try {
            $response = $this->clienteanpictures->request(
                'GET',
                "/api/cnpj/{$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    private function brasilapicnpj($cnpj){
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        $this->brasilapicnpj = new Client([
            'base_uri' => 'https://brasilapi.com.br',
        ]);

        try {
            $response = $this->brasilapicnpj->request(
                'GET',
                "/api/cnpj/v1/{$cnpj}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cnpj: {$e->getMessage()}");
        }
    }

    public function consultarCEP(string $cep, int $opcao=1){
        $cep = preg_replace('/[^0-9]/', '', (string) $cep);
        if($this->validarCEP($cep)){
            if($opcao==1){
                return $this->viacep($cep);
            }elseif($opcao==2){
                return $this->awesomeapi($cep);
            }elseif($opcao==3){
                return $this->brasilapi($cep);
            }
        }else{
            return "CEP Inválido";
        }
    }

    private function viacep($cep){
        $this->clientConsultaCNPJ = new Client([
            'base_uri' => 'https://viacep.com.br',
        ]);

        try {
            $response = $this->clientConsultaCNPJ->request(
                'GET',
                "/ws/{$cep}/json",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cep: {$e->getMessage()}");
        }
    }

    private function awesomeapi($cep){
        $this->clientawesomeapi = new Client([
            'base_uri' => 'https://cep.awesomeapi.com.br',
        ]);

        try {
            $response = $this->clientawesomeapi->request(
                'GET',
                "/json/{$cep}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cep: {$e->getMessage()}");
        }
    }

    private function brasilapi($cep){
        $this->clientawesomeapi = new Client([
            'base_uri' => 'https://brasilapi.com.br',
        ]);

        try {
            $response = $this->clientawesomeapi->request(
                'GET',
                "/api/cep/v2/{$cep}",
                [
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]
            );
            return json_decode($response->getBody()->getContents());
        } catch (ClientException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $response = $e->getResponse()->getReasonPhrase();

            return ['error' => $response, 'statusCode' => $statusCode];
        } catch (\Exception $e) {
            throw new Exception("Falha ao consultar o cep: {$e->getMessage()}");
        }
    }

    ######################################################
    ############## FERRAMENTAS ###########################
    ######################################################
    public function validarCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
    
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    private function dadosCNPJ($dados){
        $d = new stdClass;
        $d->cnpj = $dados->estabelecimento->cnpj;
        $d->xNome = $dados->razao_social;
        $d->xFant = $dados->estabelecimento->nome_fantasia;
        if(isset($dados->estabelecimento->data_inicio_atividade)){
            $d->abertura = $dados->estabelecimento->data_inicio_atividade;
        }else{
            $d->abertura = null;
        }
        $d->atualizado_em = $dados->atualizado_em;
        if(isset($dados->simples->simples)){
            $d->simples = $dados->simples->simples;
        }else{
            $d->simples = null;
        }
        $d->tipo = $dados->estabelecimento->tipo;
        $d->CEP = $dados->estabelecimento->cep;
        $d->xLgr = $dados->estabelecimento->tipo_logradouro." ".$dados->estabelecimento->logradouro;
        $d->nro = $dados->estabelecimento->numero;
        $d->xCpl = $dados->estabelecimento->complemento;
        $d->xBairro = $dados->estabelecimento->bairro;
        $d->xMun = $dados->estabelecimento->cidade->nome;
        $d->cMun = $dados->estabelecimento->cidade->ibge_id;
        $d->UF = $dados->estabelecimento->estado->sigla;
        $d->xUF = $dados->estabelecimento->estado->nome;
        $d->cUF = $dados->estabelecimento->estado->ibge_id;

        foreach ($dados->estabelecimento->inscricoes_estaduais as $value) {
            $d->IE = $value->inscricao_estadual;
            $d->IE_atualizao = $value->atualizado_em;
            $d->IE_estado = $value->estado->nome;
            $d->IE_sigla = $value->estado->sigla;
            $d->IE_ibge_id = $value->estado->ibge_id;
        }

        if(isset($dados->estabelecimento->atividade_principal->id)){
            $d->CNAE = $dados->estabelecimento->atividade_principal->id;
        }else{
            $d->CNAE = null;
        }
        if(isset($dados->estabelecimento->email)){
            $d->Email = strtolower($dados->estabelecimento->email);
        }else{
            $d->Email = null;
        }
        if(isset($dados->estabelecimento->telefone1)){
            $d->telefone = $dados->estabelecimento->ddd1.$dados->estabelecimento->telefone1;
        }else{
            $d->telefone = null;
        }
        return $d;
    }

    public function validarCEP($cep){
        $cep = preg_replace('/[^0-9]/', '', (string) $cep);

        if(!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) {
            return false;
        }
        return true;
    }
}