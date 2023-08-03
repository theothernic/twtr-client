<?php
    namespace App\Http\Clients;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Request;
    use Psr\Http\Message\ResponseInterface;

    class TwtrClient extends Client
    {
        public function __construct(array $options = [])
        {
            $config = [
                'base_uri' => config('services.twtr.api.url')
            ];

            $config = array_merge_recursive($config, $options);

            parent::__construct($config);
        }

        public function single(string $id = '') : ResponseInterface
        {
            $req = new Request('GET', sprintf('/api/tweet/%s', $id));

            return $this->send($req);
        }

        public function tweets(int $page = 1) : ResponseInterface
        {
            $req = new Request('GET', '/api/tweets');

            return $this->send($req,  [
                'query' => [
                    'page' => $page
                ]
            ]);
        }
    }
