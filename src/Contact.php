<?php

namespace CloudManaged\FreeAgent;

use CloudManaged\FreeAgent\Api\ApiResource;
use CloudManaged\FreeAgent\Errors\ApiError;
use CloudManaged\FreeAgent\Errors\ContactError;

class Contact extends ApiResource
{
    public function getContactsUrl()
    {
        return $this->getUrlBase() . 'contacts';
    }

    /**
     * Create contact
     *
     * @see https://dev.freeagent.com/docs/contacts#create-a-contact
     * @param $params
     *
     * @return mixed
     * @throws ContactError
     */
    public function createContact($params)
    {
        try {
            $url = $this->getContactsUrl();

            $data = ['contact' => $params];
            return $this->save($url, $data);
        } catch (ApiError $e) {
            throw new ContactError($e);
        }

    }

    /**
     * Update contact
     *
     * @see https://dev.freeagent.com/docs/contacts#update-a-contact
     * @param      $params
     * @param null $contactId
     *
     * @return bool
     * @throws ContactError
     */
    public function updateContact($params, $contactId = null)
    {
        try {
            $url = $this->getContactsUrl() . '/' . $contactId;

            $data = ['contact' => $params];
            return $this->update($url, $data);
        } catch (ApiError $e) {
            throw new ContactError($e);
        }
    }

    /**
     * Get a single contact
     * 
     * @see https://dev.freeagent.com/docs/contacts#get-a-single-contact
     * @param $contactId
     * 
     * @return mixed
     * @throws ContactError
     */
    public function getASingleContact($contactId)
    {
        try {

            $url = $this->getContactsUrl();
            $url = $url . '/' . $contactId;
            $response = $this->retrieve($url, []);
            return $response['contact'];

        } catch (ApiError $e) {
            throw new ContactError($e);
        }
    }
}
