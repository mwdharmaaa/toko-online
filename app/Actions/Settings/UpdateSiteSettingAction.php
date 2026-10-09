<?php

namespace App\Actions\Settings;

use App\Models\SiteSetting;

class UpdateSiteSettingAction
{
    public function execute(SiteSetting $setting, array $data): SiteSetting
    {
        $setting->update($data);
        return $setting;
    }
}
