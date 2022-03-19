<?php


namespace app\core\ActiveRecord;


use GuzzleHttp\Client;

class Connection
{
    /**
     * The HTTP Client
     *
     * @var Client
     */
    protected Client $client;

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

    public function get($url, array $params = [])
    {
        $request = $this->client()->createRequest('GET', $url);

        $query = $request->getQuery();

        foreach ($params as $k => $v) {
            $query->set($k, $v);
        }

        return $this->client()->send($request);
    }

    public function post($url, $body)
    {
        return $this->client()->post($url, ['body' => $body]);
    }

}
