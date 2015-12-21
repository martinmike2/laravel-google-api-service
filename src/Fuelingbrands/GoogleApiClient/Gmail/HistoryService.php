<?php namespace Fuelingbrands\GoogleApiClient\Gmail;

class HistoryService extends GmailApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->gmail->users_history;
    }

    /**
     * @param string $user_email
     * @param integer $history_id Only return Histories at or after history_id.
     * @return array
     */
    public function listHistory($user_email, $history_id)
    {
        $opt_param = array('startHistoryId' => $history_id);
        $pageToken = NULL;
        $histories = array();

        do {
            try {
                if ($pageToken) {
                    $opt_param['pageToken'] = $pageToken;
                }
                $historyResponse = $this->createService()->listUsersHistory($user_email, $opt_param);
                if ($historyResponse->getHistory()) {
                    $histories = array_merge($histories, $historyResponse->getHistory());
                    $pageToken = $historyResponse->getNextPageToken();
                }
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
            }
        } while ($pageToken);


        return $histories;

    }
}