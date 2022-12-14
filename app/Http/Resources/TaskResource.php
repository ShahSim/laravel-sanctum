<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        $this->id = (string)$this->id;
        $this->user_id = (string)$this->user_id;

        return [
            'id' => $this->id,
            'attribute' => [
                'name' => $this->name,
                'description' => $this->description,
                'priority' => $this->priority,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],
            'relationships' => [
                'user_id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]

        ];
    }
}
