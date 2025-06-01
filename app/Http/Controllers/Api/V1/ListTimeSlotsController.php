<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ListTimeSlotsService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListTimeSlotsController extends Controller
{
    public function __construct(public ListTimeSlotsService $service)
    {
    }

    public function __invoke(): ResourceCollection
    {
        return $this->service->getTimeSlots();
    }
}
