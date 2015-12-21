<?php namespace Fuelingbrands\GoogleApiClient\Gmail;

use Fuelingbrands\GoogleApiClient\Api;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class GmailApi extends Api
{
    use GoogleApiTrait;

    const MAIN_GMAIL_SCOPE = "https://mail.google.com/";
    const MODIFY_GMAIL_SCOPE = "https://www.googleapis.com/auth/gmail.modify";
    const COMPOSE_GMAIL_SCOPE = "https://www.googleapis.com/auth/gmail.compose";
    const GMAIL_READONLY = "https://www.googleapis.com/auth/gmail.readonly";

    /**
     * @var \Google_Service_Gmail
     */
    protected $gmail;

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        parent::__construct($email, $private_key, $scopes, $impersonated_email);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getResource()
    {
        return new \Google_Service_Gmail($this->client);
    }
}