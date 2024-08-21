<?php

namespace App\Service\PostalCode;

use Exception;
use http\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PostalCodeService implements PostalCodeInterface
{
    protected string $postalCode;
    protected string $result;
    protected string $baseUrl;

    /**
     * @throws Exception
     */
    public function requestPostalCode(string $postalCode): array
    {
        $this->baseUrl =  env('VIA_CEP_URL', 'http://viacep.com.br/ws');
        $this->validPostalCode($postalCode);
        $this->getInformationByPostalCode();
        $result = json_decode($this->result, true);

        if(isset($result['erro'])){
            throw new UnprocessableEntityHttpException('Cep não encontrado' );
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    protected function validPostalCode($postalCode)
    {
        $formatedPostalCode = preg_replace("/[^0-9]/", "", $postalCode);
        if (!preg_match('/^[0-9]{8}?$/', $formatedPostalCode)) {
            throw new UnprocessableEntityHttpException("CEP inválido");
        }
        $this->postalCode = $formatedPostalCode;
    }

    protected function getInformationByPostalCode()
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        $url = $this->baseUrl .'/'. $this->postalCode .'/json/';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSLVERSION,3);
        $this->result = curl_exec($ch);
        curl_close($ch);
    }
}
