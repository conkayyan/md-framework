<?php
/**
 * @description     Curl
 * @author          conkayyan<conkay@foxmail.com>
 * @Date            2017/12/2
 */
namespace common\components;

use GuzzleHttp\Client;

class Curl
{
    /**
     * @param $uri
     * @param array $form_params
     * @param array $options
     * @return string
     */
    public function post($uri, $form_params = [], $options = [])
    {
        !empty($form_params) && $options = array_merge(['form_params' => $form_params], $options);
        return (string)((new Client())->post($uri, $options)->getBody());
    }

    /**
     * @param $uri
     * @param array $form_params
     * @param array $options
     * @return string
     */
    public function get($uri, $form_params = [], $options = [])
    {
        !empty($form_params) && $options = array_merge(['query' => $form_params], $options);
        return (string)((new Client())->get($uri, $options)->getBody());
    }

    /**
     * @param $uri
     * @param array $form_params
     * @param array $options
     * @return string
     */
    public function delete($uri, $form_params = [], $options = [])
    {
        !empty($form_params) && $options = array_merge(['form_params' => $form_params], $options);
        return (string)((new Client())->delete($uri, $options)->getBody());
    }

    /**
     * @param $uri
     * @param array $form_params
     * @param array $options
     * @return string
     */
    public function put($uri, $form_params = [], $options = [])
    {
        !empty($form_params) && $options = array_merge(['form_params' => $form_params], $options);
        return (string)((new Client())->put($uri, $options)->getBody());
    }

    /**
     * @param $method
     * @param $uri
     * @param array $form_params
     * @param array $options
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri, $form_params = [], $options = [])
    {
        !empty($form_params) && $options = array_merge(['form_params' => $form_params], $options);
        return (string)((new Client())->request($method, $uri, $options)->getBody());
    }
}