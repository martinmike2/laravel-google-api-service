<?php namespace Fuelingbrands\GoogleApiClient\Spreadsheet;

use Google\Spreadsheet\CellFeed;

/**
 * Class SpreadsheetService
 * @package Fuelingbrands\GoogleApiClient\Spreadsheet
 */
class SpreadsheetService extends SpreadsheetApi
{

    /**
     * Update google spreadsheet cell data
     *
     * @param CellFeed $feed
     * @param array $cells
     */
    public function setCells($worksheet_id, array $cells)
    {
        $feed = $this->getService()->getCellFeed($worksheet_id);
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
     * Get the content of a specific cell on the worksheet
     *
     * @param $worksheet_id
     * @param $location
     * @return null
     */
    public function readCell($worksheet_id, $location)
    {
        $feed = $this->getService()->getCellFeed($worksheet_id);

        foreach ($feed->getEntries() as $cell)
        {
            if ($cell->getTitle() == $location)
            {
                return $cell->getContent();
            }
        }

        return null;
    }

    /**
     * Get the content of a specific row on the worksheet
     *
     * @param $worksheet_id
     * @param $row_number
     * @return null
     */
    public function readRow($worksheet_id, $row_number)
    {
        $feed = $this->getService()->getListFeed($worksheet_id);

        foreach($feed->getEntries() as $row)
        {
            if($row->getId() == $row_number) {
                return $row->getContent();
            }
        }

        return null;
    }

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->getSpreadsheetService();
    }
}