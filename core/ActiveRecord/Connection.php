<?php


namespace app\core\ActiveRecord;


use GuzzleHttp\Client;

/**
 * Class Connection
 *
 * @author karam mustafa
 * @package app\core\ActiveRecord
 */
class Connection
{
    /**
     * The HTTP Client
     *
     * @var Client
     */
    protected Client $client;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    private string $subDomain;
    /**
     *
     * @author karam mustafa
     * @var string
     */
    private string $key;

    /**
     * Connection constructor.
     *
     * @param $key
     * @param $subDomain
     */
    public function __construct($key, $subDomain = null)
    {
        $this->key = $key;
        $this->subDomain = $subDomain;
    }
    /**
     * description
     *
     * @return \GuzzleHttp\Client
     * @author karam mustafa
     */
    public function client()
    {
        if ($this->client) {
            return $this->client;
        }

        return new Client([
            'base_url' => "ANY",
            'defaults' => [
                'auth' => [$this->key, 'x', 'basic'],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        ]);
    }

    /**
     * get request
     *
     * @param $url
     * @param  array  $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author karam mustafa
     */
    public function get($url, array $params = [])
    {
        $request = $this->client()->createRequest('GET', $url);

        $query = $request->getQuery();

        foreach ($params as $k => $v) {
            $query->set($k, $v);
        }

        return $this->client()->send($request);
    }

    /**
     * post request
     *
     * @param $url
     * @param $body
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author karam mustafa
     */
    public function post($url, $body)
    {
        return $this->client()->post($url, ['body' => $body]);
    }

    /**
     * put request
     *
     * @param $url
     * @param $body
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author karam mustafa
     */
    public function put($url, $body)
    {
        return $this->client()->put($url, ['body' => $body]);
    }

    /**
     * delete request
     *
     * @param $url
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author karam mustafa
     */
    public function delete($url)
    {
        return $this->client()->delete($url);
    }

}
