<?php namespace Fuelingbrands\GoogleApiClient\Spreadsheet;

use Fuelingbrands\GoogleApiClient\Api;
use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;
use Google\Spreadsheet\CellFeed;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\SpreadsheetService;

abstract class SpreadsheetApi
{
    use GoogleApiTrait;

    /**
     * The Spreadsheet Scope to
     * authenticate with
     *
     * @var string
     */
    protected $scope = 'https://spreadsheets.google.com/feeds';

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

    public function getSpreadsheetService()
    {
        if(is_null($this->service)) {
            $this->setSpreadsheetService();
        }

        return $this->service;
    }

    public function setSpreadsheetService()
    {
        ServiceRequestFactory::setInstance($this->getRequest());
        $this->service = new SpreadsheetService();
    }

    /**
     * Get the File Service Client
     *
     * @return GoogleClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the spreadsheet scope
     *
     * @return void
     */
    protected function setScope()
    {
        $this->getClient()->addScope($this->scope);
    }

    /**
     * Get the Authorization token for
     * a google spreadsheet request
     * with required scope
     *
     * @return mixed
     */
    protected function getAccessToken()
    {
        $this->setScope();
        $auth = $this->getClient()->getAuth();
        $access = json_decode($auth->getAccessToken(), true);

        return array_get($access, 'access_token');
    }

    /**
     * Get the Default Service Request Instance
     *
     * @return DefaultServiceRequest
     */
    protected function getRequest()
    {
        return new DefaultServiceRequest($this->getAccessToken());
    }

    /**
     * Dynamically pass method requests to the spreadsheet service.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->service, $method], $parameters);
    }

    abstract public function setCells(CellFeed $feed, array $cells);
}