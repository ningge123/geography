<?php
/**
 * Created by PhpStorm.
 * User: cocoyo
 * Date: 2017/9/15 0015
 * Time: 16:35
 */
namespace Cocoyo\Geography;

use Cocoyo\Geography\Exceptions\InvalidArgumentException;
use Cocoyo\Geography\Support\Config;
use GuzzleHttp\Client;

class Geography
{
    /**
     * aliyun API url
     * @var string
     */
    protected $api = "https://api.map.baidu.com/location/ip?";

    /**
     * @var Client
     */
    protected $http;

    /**
     * @var array
     */
    protected $config;

    /**
     * Geography constructor.
     *
     * @param array $config
     */
    public function __construct(array $config  = [])
    {
        $this->http = new Client();
        $this->config = new Config($config);
    }

    /**
     * @param $ip
     * @return mixed
     */
    public function position($ip)
    {
        $url = $this->getGeographyUrl($ip);
        $response = $this->http->get($url);

        return $this->handleResponse(json_decode($response->getBody(), true));
    }

    /**
     * @param array $response
     * @return mixed
     */
    public function handleResponse(array $response)
    {
        if ((int) $response['status'] === 0) {
            return $response['content'];
        }

        throw new InvalidArgumentException("error!error_code:" . $response['status'] .", error_message:" . $response['message']);
    }

    /**
     *
     * @param $ip
     * @return array
     */
    private function getGeographyUrl($ip)
    {
        $ak = $this->config->get('ak');
        if (is_array($ak)) {
            $ak = config('services.baidu.ak');
        }

        $query = [
            'ak' => $ak,
            'ip' => $ip
        ];

        return $this->api . http_build_query($query);
    }
}