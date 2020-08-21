<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
            'email'                  => $this->email,
            'weekly_visits_count'    => $this->visits()->weekly()->count(),
            'monthly_visits_count'   => $this->visits()->monthly()->count(),
            'weekly_views_count'     => $this->views()->weekly()->count(),
            'monthly_views_count'    => $this->views()->monthly()->count(),
        ];
    }
}
