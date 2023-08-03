<?php
    namespace App\ViewModels;

    use Illuminate\Database\Eloquent\Collection;

    class PageViewModel
    {
        public function __construct()
        {
        }

        public string $title = '';

        public array $meta = [
            'keywords' => '',
            'description' => ''
        ];

        public mixed $data;

        public int $prevPageNum = 0;

        public int $currentPageNum = 0;

        public int $nextPageNum = 0;

        public int $totalPages = 0;

        public int $total = 0;

        public function setPageNumber(int $current = 0)
        {
            $this->currentPageNum = $current;
            $this->nextPageNum = $current + 1;
            $this->prevPageNum = $current - 1;

            $this->calculateTotalPages();
            $this->checkMaxPageNum();
        }

        private function calculateTotalPages()
        {
            $rCount = 0;

            if (gettype($this->data) == Collection::class)
                $rCount = $this->data->count();
            else
                $rCount = count($this->data);

            $this->totalPages = $this->total / $rCount;

            if ($this->total % $rCount > 0)
                $this->totalPages += 1;
        }

        public function checkMaxPageNum()
        {
            if ($this->nextPageNum > $this->totalPages)
                $this->nextPageNum = 0;
        }
    }
