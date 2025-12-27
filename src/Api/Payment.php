<?php

namespace Softr\Asaas\Api;

// Entities
use Softr\Asaas\Entity\BankSlipLineEntity;
use Softr\Asaas\Entity\Payment as PaymentEntity;
use Softr\Asaas\Entity\PixQrCodeEntity;
use Softr\Asaas\Exception\HttpException;

/**
 * Payment API Endpoint
 *
 * @author Agência Softr <agencia.softr@gmail.com>
 */
class Payment extends \Softr\Asaas\Api\AbstractApi
{
    /**
     * Get paginate payments
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Payments Array
     */
    public function getPaginate(array $filters = [])
    {
        $payments = $this->adapter->get(sprintf('%s/payments?%s', $this->endpoint, http_build_query($filters)));

        $payments = json_decode($payments);

        $this->extractMeta($payments);

        return $payments;
    }

    /**
     * Get all payments
     *
     * @param   array  $filters  (optional) Filters Array
     * @return  array  Payments Array
     */
    public function getAll(array $filters = [])
    {
        $payments = $this->adapter->get(sprintf('%s/payments?%s', $this->endpoint, http_build_query($filters)));

        $payments = json_decode($payments);

        $this->extractMeta($payments);

        return array_map(function ($payment) {
            return new PaymentEntity($payment);
        }, $payments->data);
    }

    /**
     * Get Payment By Id
     *
     * @param   int  $id  Payment Id
     * @return  PaymentEntity
     */
    public function getById($id)
    {
        $payment = $this->adapter->get(sprintf('%s/payments/%s', $this->endpoint, $id));

        $payment = json_decode($payment);

        return new PaymentEntity($payment);
    }

    /**
     * Get Payments By Customer Id
     *
     * @param   int    $customerId  Customer Id
     * @param   array  $filters     (optional) Filters Array
     * @return  array|PaymentEntity[]
     */
    public function getByCustomer($customerId, array $filters = [])
    {
        $payments = $this->adapter->get(sprintf('%s/customers/%s/payments?%s', $this->endpoint, $customerId, http_build_query($filters)));

        $payments = json_decode($payments);

        $this->extractMeta($payments);

        return array_map(function ($payment) {
            return new PaymentEntity($payment);
        }, $payments->data);
    }

    /**
     * Get Payments By Subscription Id
     *
     * @param   int    $subscriptionId  Subscription Id
     * @param   array  $filters         (optional) Filters Array
     * @return  array|PaymentEntity[]
     */
    public function getBySubscription($subscriptionId, array $filters = [])
    {
        $payments = $this->adapter->get(sprintf('%s/subscriptions/%s/payments?%s', $this->endpoint, $subscriptionId, http_build_query($filters)));

        $payments = json_decode($payments);

        $this->extractMeta($payments);

        return array_map(function ($payment) {
            return new PaymentEntity($payment);
        }, $payments->data);
    }

    /**
     * Create New Payment
     *
     * @param   array  $data  Payment Data
     * @return  PaymentEntity
     */
    public function create(array $data)
    {
        $payment = $this->adapter->post(sprintf('%s/payments', $this->endpoint), $data);

        $payment = json_decode($payment);

        return new PaymentEntity($payment);
    }

    /**
     * Return Pìx Qr Code
     *
     * @param   int $id Payment Id
     * @return  PixQrCodeEntity
     * @throws  HttpException
     */
    public function getPixQrCode($id)
    {
        $response = $this->adapter->post(sprintf('%s/payments/%s/pixQrCode', $this->endpoint, $id));

        $qrCode = json_decode($response);

        return new PixQrCodeEntity($qrCode);
    }

    /**
     * Return the Bank Slip payment identification field
     *
     * @param   int $id Payment Id
     * @return  BankSlipLineEntity
     * @throws  HttpException
     */
    public function getBankSlipIdentificationField($id)
    {
        $response = $this->adapter->post(sprintf('%s/payments/%s/identificationField', $this->endpoint, $id));

        $line = json_decode($response);

        return new BankSlipLineEntity($line);
    }

    /**
     * Update Payment By Id
     *
     * @param   string  $id    Payment Id
     * @param   array   $data  Payment Data
     * @throws  HttpException
     * @return  PaymentEntity
     */
    public function update($id, array $data)
    {
        $payment = $this->adapter->post(sprintf('%s/payments/%s', $this->endpoint, $id), $data);

        $payment = json_decode($payment);

        return new PaymentEntity($payment);
    }

    /**
     * Refund a Payment By Id
     *
     * @param   string  $id    Payment Id
     * @param   array   $data  Payment Data
     * @return  PaymentEntity
     */
    public function refund($id, array $data)
    {
        $payment = $this->adapter->post(sprintf('%s/payments/%s/refund', $this->endpoint, $id), $data);

        $payment = json_decode($payment);

        return new PaymentEntity($payment);
    }

    /**
     * Delete Payment By Id
     *
     * @param  string|int  $id  Payment Id
     */
    public function delete($id)
    {
        $this->adapter->delete(sprintf('%s/payments/%s', $this->endpoint, $id));
    }

    /**
     * Delete Payment By Id
     *
     * @param  string|int  $id  Payment Id
     */
    public function deleteInstallment($id)
    {
        $this->adapter->delete(sprintf('%s/installments/%s', $this->endpoint, $id));
    }
}
