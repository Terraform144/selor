<?php

use Omnipay\Omnipay;

class Payment
{
  private $gateway;

  public function __construct($apiKey)
  {
    $this->gateway = Omnipay::create('Mollie');
    $this->gateway->setApiKey($apiKey);
  }

  public function purchase($amount, $description, $returnUrl)
  {
    $response = $this->gateway->purchase(array(
      'amount' => $amount,
      'currency' => 'EUR',
      'description' => $description,
      'returnUrl' => $returnUrl
    ))->send();

    if ($response->isSuccessful()) {
      // Payment was successful
      return $response->getTransactionReference();
    } elseif ($response->isRedirect()) {
      // Redirect to offsite payment gateway
      $response->redirect();
    } else {
      // Payment failed
      return $response->getMessage();
    }
  }

  public function updatePayment($transactionReference, $amount)
  {
    $response = $this->gateway->updatePayment(array(
      'transactionReference' => $transactionReference,
      'amount' => $amount
    ))->send();

    if ($response->isSuccessful()) {
      // Payment was updated successfully
      return true;
    } else {
      // Payment update failed
      return $response->getMessage();
    }
  }

  public function cancelPayment($transactionReference)
  {
    $response = $this->gateway->cancel(array(
      'transactionReference' => $transactionReference
    ))->send();

    if ($response->isSuccessful()) {
      // Payment was cancelled successfully
      return true;
    } else {
      // Payment cancel failed
      return $response->getMessage();
    }
  }
}