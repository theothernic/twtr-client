<?php
    namespace App\Services;

    use App\Http\Clients\TwtrClient;
    use App\Models\Tweet;
    use Illuminate\Http\Client\HttpClientException;
    use Illuminate\Support\Facades\Cache;

    class TweetService
    {
        private TwtrClient $client;

        public function __construct(TwtrClient $t)
        {
            $this->client = $t;
        }

        public function get(string $id = '') : array|null
        {
            if (empty($id))
                return null;

            try {
                $json = Cache::remember(sprintf('TweetService__get_%s', $id), 60,
                function () use ($id) {
                    $res = $this->client->single($id);

                    // status code error handling?
                    if ($res->getStatusCode() !== 200)
                        $this->handleError();

                    return json_decode($res->getBody()->getContents());
                });

                $result = new Tweet($json->data);

                return [
                    'total' => $json->total,
                    'current' => $json->current,
                    'group' => $json->perPage ?? null,
                    'data' => $result
                ];


            }

            catch (HttpClientException $e)
            {
                throw $e;
            }
        }

        public function paginated(int $page = 1)
        {
            $result = collect();

            try {
                $json = Cache::remember(sprintf('TweetService__paginated_Page%s', $page), 60,
                function () use ($page) {
                    $res = $this->client->tweets($page);

                    // status code error handling?
                    if ($res->getStatusCode() !== 200)
                        $this->handleError();

                    return json_decode($res->getBody()->getContents());
                });

                foreach($json->data as $record)
                    $result->push(new Tweet($record));

                return [
                    'total' => $json->total,
                    'current' => $json->current,
                    'group' => $json->perPage ?? null,
                    'data' => $result
                ];
            }

            catch (HttpClientException $e)
            {
                throw $e;
            }

        }

        protected function handleError() {}
    }
