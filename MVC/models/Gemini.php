<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


  class Gemini
  {
      protected $liveUrl = 'https://api.gemini.com';
      protected $apiKey;
      protected $secretKey;
      protected $baseUrl;
      protected $http;

      /**
       * Gemini constructor.
       * @param $apiKey
       * @param $secretKey
       * @param bool $sandbox
       */
      public function __construct($apiKey, $secretKey)
      {
          $this->apiKey = $apiKey;
          $this->secretKey = $secretKey;

          $this->http = new Client([
              'base_uri' => $this->liveUrl
          ]);
      }

      /**
       * Send a request for a new crypto-currency deposit address with an optional label.
       * Returns the response.
       *
       * @param string $label optional label for the deposit address
       * @return mixed
       */
      public function createAddress($label = null)
      {
          $endpoint = "/v1/deposit/btc/newAddress";

          $params = [
              'request' => $endpoint,
              'nonce' => $this->getNonce()
          ];

          if ($label) {
              $params['label'] = $label;
          }

//checks to make sure CreateAddress works, and if not let controller know
      try {
        $apple = $this->post($endpoint, $params)->address;
      } catch (\Exception $e) {
        return false;
      }
      return $apple;
      }

      /**
       * Send an account balance request, return the response.
       *
       * @return string
       */
      public function balances()
      {
          $endpoint = '/v1/balances';

          $params = [
              'request' => $endpoint,
              'nonce' => $this->getNonce()
          ];

          return $this->post($endpoint, $params);
      }

      /**
       * @param $endpoint
       * @param $params
       * @return mixed
       */
      private function post($endpoint, $params)
      {


          $response = $this->http->post($endpoint, [
                  'headers' => $this->prepareHeaders($params)
              ]
          );



          return json_decode($response->getBody()->getContents());
      }

      /**
       * @return float|int
       */
      protected function getNonce()
      {
          list($microSec, $sec) = explode(' ', microtime());

          return (int)$microSec + (int)$sec * 1000000;
      }

      /**
       * Prepare, return the required HTTP headers.
       *
       * Base 64 encode the parameters, sign it with the secret key,
       * create the HTTP headers, return the whole payload.
       *
       * @param $params
       * @return array
       */
      protected function prepareHeaders($params)
      {
          $payload = base64_encode(json_encode($params, JSON_FORCE_OBJECT));

          $signature = hash_hmac('sha384', $payload, $this->secretKey);

          return [
              'X-GEMINI-APIKEY' => $this->apiKey,
              'X-GEMINI-PAYLOAD' => $payload,
              'X-GEMINI-SIGNATURE' => $signature
          ];
      }

  }
