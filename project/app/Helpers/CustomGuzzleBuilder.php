<?php

namespace App\Helpers;

use Exception;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use function GuzzleHttp\json_decode;

class CustomGuzzleBuilder
{
	public function getHeader() {
        $headers = [
            'Accept'    => 'application/json',
        ];

        return $headers;
    }

    public function get_method($url, $post_fields = array()) {
        try {

            $http = new Client();

            $response = array(
                'content'   => array(),
                'code'      => 200
            );

            $request = $http->request('GET', $url, [
                'headers' => $this->getHeader(),
                'form_params' => $post_fields
            ]);

            $response['content'] = json_decode((string) $request->getBody(), true);

        } catch(ClientException $exception) {
            throw $exception;
        } catch(ServerException $exception) {
            throw $exception;
        } catch(Exception $exception) {
            throw $exception;
        }

        return $response;
    }

    public function post_method($url, $post_fields) {
        try {

            $http = new Client();

            $response = array(
                'content'   => array(),
                'code'      => 200
            );

            $request = $http->request('POST', $url, [
                'headers' => $this->getHeader(),
                'form_params' => $post_fields
            ]);

            $response['content'] = json_decode((string) $request->getBody(), true);

        } catch(ClientException $exception) {
            throw $exception;
        } catch(ServerException $exception) {
            throw $exception;
        } catch(Exception $exception) {
            throw $exception;
        }

        return $response;
    }
}
