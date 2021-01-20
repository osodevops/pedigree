<?php

namespace App\Observers;

use App\Models\Difference;
use App\Jobs\CacheDifference;

class DifferenceObserver
{
    /**
     * Handle the Difference "created" event.
     *
     * @param  \App\Models\Difference  $difference
     * @return void
     */
    public function created(Difference $difference)
    {
        CacheDifference::dispatchAfterResponse(
            $difference->baseRepository,
            $difference->repository
        );
    }
}
