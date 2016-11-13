<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Illuminate\Support\Collection;

/**
 * Class SettingsService
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
class SettingsService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->settings;
    }

    /**
     * Get a single Calendar Setting
     *
     * @param       $settingId
     * @param array $params
     *
     * @return \Google_Service_Calendar_Setting|null
     */
    public static function get($settingId, array $params = [])
    {
        try {
            return self::getService()->get($settingId, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve all Calendar Settings
     *
     * @param       $maxResults
     * @param null  $pageToken
     * @param null  $syncToken
     * @param array $params
     *
     * @return Collection
     */
    public static function listSettings($maxResults, $pageToken = null, $syncToken = null, array $params = [])
    {
        $settingsCollection = new Collection();

        try {
            $requestParams = [
                'maxResults' => $maxResults,
                'pageToken' => $pageToken,
                'syncToken' => $syncToken
            ];
            $settings = self::getService()->list($requestParams, $params);

            foreach ($settings as $setting) {
                $settingsCollection->put($setting->getId(), $setting->getValue());
            }

            return $settingsCollection;
        } catch (\Google_Service_Exception $e)
        {
            \Log::error($e->getMessage());
            return $settingsCollection;
        }
    }
}