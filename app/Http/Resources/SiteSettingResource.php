<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'store_name' => $this->store_name,
            'store_tagline' => $this->store_tagline,
            'welcome_title' => $this->welcome_title,
            'welcome_subtitle' => $this->welcome_subtitle,
            'whatsapp_number' => $this->whatsapp_number,
            'store_email' => $this->store_email,
            'store_address' => $this->store_address,
            'instagram_handle' => $this->instagram_handle,
        ];
    }
}
