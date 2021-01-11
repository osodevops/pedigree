<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total = collect($this->resource)->sum();

        if ($total == 0) {
            return [];
        }

        return collect($this->resource)->mapWithKeys(function ($data, $language) use ($total) {
            return [$language => [
                'lines' => $data,
                'percentage' => round(($data / $total) * 100, 2)
            ]];
        });
    }
}
