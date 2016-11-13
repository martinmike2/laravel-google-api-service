<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class FreeBusyService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->freebusy;
    }

    public static function query(Carbon $timeMin, Carbon $timeMax, $timeZone, $groupExpansionMax, $calendarExpansionMax, array $items, array $params = [])
    {
        $request = new \Google_Service_Calendar_FreeBusyRequest();
        $request->setTimeMin($timeMin);
        $request->setTimeMax($timeMax);
        $request->setTimeZone($timeZone);
        $request->setGroupExpansionMax($groupExpansionMax);
        $request->setCalendarExpansionMax($calendarExpansionMax);

        $itemCollection = new Collection();

        foreach ($items as $item) {
            $requestItem = new \Google_Service_Calendar_FreeBusyRequestItem();
            $requestItem->setId($item);
            $itemCollection->push($requestItem);
        }

        $request->setItems($itemCollection->toArray());

        try {
            return self::getService()->query($request, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }
}