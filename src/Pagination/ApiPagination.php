<?php

namespace App\Pagination;

/** @phan-suppress PhanWriteOnlyPublicProperty */
class ApiPagination {
    public readonly int $count;
    public readonly int $current;
    public readonly int|null $next;
    public readonly int|null $previous;
    public readonly array $items;

    public function __construct(int $count, int $current, int|null $next, int|null $previous, array $items) {
        $this->count = $count;
        $this->current = $current;
        $this->next = $next;
        $this->previous = $previous;
        $this->items = $items;
    }
}
