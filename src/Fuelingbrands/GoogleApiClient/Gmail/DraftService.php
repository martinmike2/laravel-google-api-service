<?php namespace Fuelingbrands\GoogleApiClient\Gmail;

use Fuelingbrands\GoogleApiClient\Gmail\Resources\GmailDraft;
use Fuelingbrands\GoogleApiClient\Gmail\Resources\GmailMessage;

class DraftService extends GmailApi
{

    /**
     * Tell the API which Service to use
     * @return \Google_Service_Gmail_UsersDrafts_Resource
     */
    protected function createService()
    {
        return $this->gmail->users_drafts;
    }

    /**
     * Create a draft message
     *
     * @param $user_email
     * @param $message
     * @return null
     */
    public function create($user_email, $message)
    {
        $draft = new GmailDraft();
        $draft->setMessage($message);

        try {
            return $this->getService()->create($user_email, $draft);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * @param string $email Email formatted string
     * @return GmailMessage Message containing the email
     */
    public function getFormattedMessage($email)
    {
        $message = new GmailMessage();
        $message->setRaw(base64_encode($email));
        return $message;
    }

    /**
     * Get the message in a draft email
     *
     * @param GmailDraft $draft
     * @return mixed
     */
    public function getMessageFromDraft(GmailDraft $draft)
    {
        return $draft->getMessage();
    }

    /**
     * Delete a draft by ID
     *
     * @param string $user_email Email Address of the user
     * @param string $draft_id ID of the draft message
     * @return null
     */
    public function delete($user_email, $draft_id)
    {
        try {
            $this->getService()->delete($user_email, $draft_id);
            return true;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * Get a draft message by ID
     *
     * @param string $user_email
     * @param string $draft_id
     * @param string $format
     * @return GmailDraft|null
     */
    public function get($user_email, $draft_id, $format = 'full')
    {
        try {
            return $this->getService()->get($user_email, $draft_id, ['q' => 'format = ' . $format]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve a list of draft emails for a user
     *
     * @param string $user_email
     * @param array $query
     * @return array
     */
    public function listDrafts($user_email, $query = [])
    {
        $drafts = [];

        try {
            $response = $this->getService()->listUsersDrafts($user_email, $query);

            if ($response->getDrafts()) {
                array_merge($drafts, $response->getDrafts());
            }
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return $drafts;
    }

    /**
     * Update the message in a draft
     *
     * @param string $user_email
     * @param string $draft_id
     * @param GmailMessage $updated_message
     * @param bool|false $send
     * @return GmailDraft|null
     */
    public function updateDraft($user_email, $draft_id, $updated_message, $send = false)
    {
        $opt_param = array('send' => $send);
        $draft = new GmailDraft();
        $draft->setMessage($updated_message);
        try {
            return $this->getService()->update($user_email, $draft_id, $draft, $opt_param);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * Send a draft message
     *
     * @param string $user_email
     * @param GmailDraft $postBody
     * @param array $query
     * @return array|null
     */
    public function send($user_email, GmailDraft $postBody, $query = [])
    {
        try {
            return $this->getService()->send($user_email, $postBody, $query);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }
}