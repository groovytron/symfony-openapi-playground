<?php
namespace App\Controller;

use App\OpenApiBundle\Controller\EventsController;
use App\OpenApiBundle\Api\EventsApiInterface;
use App\Pagination\ApiPagination;

/**
 * @phan-suppress-next-next-line PhanUnreferencedClass
 */
class EventController extends EventsController implements EventsApiInterface
{
    public function listEvents(
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $events = [
            [
                'uuid' => '123',
                'name' => 'first',
            ],
            [
                'uuid' => '321',
                'name' => 'second',
            ]
        ];

        $pagination = new ApiPagination(
            count($events), 2, 3, 1, $events
        );

        return $pagination;
    }
}
