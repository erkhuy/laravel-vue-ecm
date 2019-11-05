<?php

namespace App\Http\Resources\Backend;

use App\Model\Backend\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleResources extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'role' => new RoleResource($this->role),
            'phone' => $this->phone,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}