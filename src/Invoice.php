<?php

namespace CloudManaged\FreeAgent;

use CloudManaged\FreeAgent\Api\ApiResource;
use CloudManaged\FreeAgent\Errors\ApiError;
use CloudManaged\FreeAgent\Errors\InvoiceError;

class Invoice extends ApiResource
{
    public function getInvoiceUrl()
    {
        return $this->getUrlBase() . 'invoices';
    }

    /**
     * Create an invoice
     * An invoice is always created with a status of Draft. You must use the status
     * transitions to mark an invoice as Draft, Sent, Scheduled or Cancelled.
     *
     * @see https://dev.freeagent.com/docs/invoices#create-an-invoice
     * @param $data
     *
     * @return mixed
     * @throws InvoiceError
     */
    public function createAnInvoice($data)
    {
        try {
            $url = $this->getInvoiceUrl();
            $data = ['invoice' => $data];
            return $this->save($url, $data);
        } catch (ApiError $e) {
            throw new InvoiceError($e);
        }
    }

    /**
     * Mark invoice as sent
     *
     * @see https://dev.freeagent.com/docs/invoices#mark-invoice-as-sent
     * @param $invoiceId
     *
     * @return mixed
     * @throws InvoiceError
     */
    public function markInvoiceAsSent($invoiceId)
    {
        file_put_contents('/tmp/stripe-to-freeagent-flow.txt', "markInvoiceAsSent-action \n", FILE_APPEND);

        try {
            $url = $this->getInvoiceUrl();
            $url = $url . '/' . $invoiceId .'/transitions/mark_as_sent';
            return $this->update($url, []);
        } catch (ApiError $e) {
            throw new InvoiceError($e);
        }
    }


    /**
     * Email an invoice
     *
     * @see https://dev.freeagent.com/docs/invoices#email-an-invoice
     * @param $invoiceId
     * @param $params
     *
     * @return mixed
     * @throws InvoiceError
     */
    public function emailAnInvoice($invoiceId, $params)
    {
        file_put_contents('/tmp/stripe-to-freeagent-flow.txt', "emailAnInvoice-action \n", FILE_APPEND);

        try {
            $url = $this->getInvoiceUrl();
            $url = $url . '/' . $invoiceId .'/send_email';

            $data = ['invoice' => ['email' => $params]];
            return $this->save($url, $data);
        } catch (ApiError $e) {
            throw new InvoiceError($e);
        }
    }

    /**
     * List all invoices related to a contact
     *
     * @return mixed
     * @throws InvoiceError
     */
    /**
     * @param $contactId
     *
     * @return mixed
     * @throws InvoiceError
     */
    public function listAllInvoicesByContact($contactId)
    {
        try {
            $url = $this->getInvoiceUrl();
            $params['contact'] = $contactId;
            $response = $this->retrieve($url, [], $params);
            return $response['invoices'];
        } catch (ApiError $e) {
            throw new InvoiceError($e);
        }
    }

    /**
     * Get a single invoice
     * 
     * @see https://dev.freeagent.com/docs/invoices#get-a-single-invoice
     * @param $invoiceId
     * 
     * @return mixed
     * @throws InvoiceError
     */
    public function getASingleInvoice($invoiceId)
    {
        try {

            $url = $this->getInvoiceUrl();
            $url = $url . '/' . $invoiceId;
            $response = $this->retrieve($url, []);
            return $response['invoice'];

        } catch (ApiError $e) {
            throw new InvoiceError($e);
        }
    }
}
