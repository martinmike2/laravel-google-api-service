<?php namespace Fuelingbrands\GoogleApiClient\Gmail;

use Fuelingbrands\GoogleApiClient\Gmail\Resources\GmailLabel;

class LabelService extends GmailApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->gmail->users_labels;
    }

    /**
     * Create a new Label
     *
     * @param string $user_email
     * @param string $label_name
     * @return GmailLabel|null
     */
    public function create($user_email, $label_name)
    {
        $label = new GmailLabel();
        $label->setName($label_name);

        try {
            return $this->getService()->create($user_email, $label);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }
}