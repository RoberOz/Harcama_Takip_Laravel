<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Expense extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
          'location' => $this->location,
          'amount' => $this->amount,
          'category_id' => $this->category_id,
          'date' => $this->date,
        ];
    }
}
