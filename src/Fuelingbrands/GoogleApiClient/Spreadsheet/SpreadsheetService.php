<?php namespace Fuelingbrands\GoogleApiClient\Spreadsheet;

use Google\Spreadsheet\CellFeed;

class SpreadsheetService extends SpreadsheetApi
{

    /**
     * Update google spreadsheet cell data
     *
     * @param CellFeed $feed
     * @param array $cells
     */
    public function setCells(CellFeed $feed, array $cells)
    {
        foreach ($feed->getEntries() as $cell)
        {
            foreach ($cells as $location => $value) {
                if($cell->getTitle() == $location) {
                    $cell->setContent($value);
                    $cell->update($value);
                }
            }
        }
    }

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->getService();
    }
}