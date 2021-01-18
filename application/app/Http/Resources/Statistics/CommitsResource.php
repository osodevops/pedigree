<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Resources\Json\JsonResource;

class CommitsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return collect($this->resource)->map(function ($week) {
            return $this->formatWeek($week);
        });
    }

    /**
     * Format the given week of data for rendering.
     *
     * @param  array  $week
     * @return array
     */
    private function formatWeek($week)
    {
        return [
            'count' => $week['days'],
            'scale' => collect($week['days'])->map(function ($count) {
                return $this->calculateScale($count);
            })
        ];
    }

    /**
     * Calculate the scale to be shown on the heatmap.
     *
     * @param  int  $count
     * @return int
     */
    private function calculateScale($count)
    {
        if ($count >= 25) {
            return 4;
        }
        if ($count >= 15) {
            return 3;
        }
        if ($count >= 8) {
            return 2;
        }
        if ($count > 0) {
            return 1;
        }
        return 0;
    }
}
