<?php

namespace App\Http\Resources\Statistics;

use Carbon\Carbon;
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
        $commits = collect($this->resource)->map(function ($week, $offset) {
            return $this->formatWeek($week, $offset);
        });

        return [
            'commits' => $commits,
            'total' => $commits->sum('total'),
        ];
    }

    /**
     * Format the given week of data for rendering.
     *
     * @param  array  $week
     * @param  int  $offset
     * @return array
     */
    private function formatWeek($week, $offset)
    {
        $weekStart = Carbon::parse($week['week']);
        $days = collect($week['days']);
        return [
            'total' => $days->sum(),
            'display_month' => $this->getDisplayMonth($offset, $weekStart),
            'dates' => $this->getDates($weekStart),
            'count' => $week['days'],
            'scale' => $days->map(function ($count) {
                return $this->calculateScale($count);
            })
        ];
    }

    private function getDates($dayOfWeek)
    {
        return collect(range(0, 6))->map(function ($day) use ($dayOfWeek) {
            if ($day > 0) {
                $dayOfWeek->addDay();
            }

            return $dayOfWeek->format("M j, Y");
        });
    }

    private function getDisplayMonth($offset, $weekStart)
    {
        if (! in_array($offset, [1, 14, 27, 40])) {
            return;
        }

        return $weekStart->format('M');
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
