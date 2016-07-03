<?php

namespace Iyzipay\Tests\Model\Mapper;

use Iyzipay\Model\CheckoutForm;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Mapper\CheckoutFormMapper;
use Iyzipay\Model\Status;
use Iyzipay\Tests\TestCase;

class CheckoutFormMapperTest extends TestCase
{
    public function test_should_map_checkout_form()
    {
        $json = '
            {
                "status": "failure",
                "errorCode":"10000",
                "errorMessage":"error message",
                "errorGroup":"ERROR_GROUP",
                "locale": "tr",
                "systemTime": 1458545234852,
                "conversationId": "123456",
                "price": 1.0,
                "paidPrice": 1.1,
                "installment": 1,
                "paymentId": "1",
                "paymentStatus": null,
                "fraudStatus": 1,
                "merchantCommissionRate": 10.00000000,
                "merchantCommissionRateAmount": 0.1,
                "iyziCommissionRateAmount": 0.03245000,
                "iyziCommissionFee": 0.29500000,
                "cardType": "CREDIT_CARD",
                "cardAssociation": "MASTER_CARD",
                "cardFamily": "Bonus",
                "cardUserKey": "cardUserKey",
                "cardToken": "cardToken",
                "binNumber": "554960",
                "basketId": "B67832",
                "currency": "TRY",
                "connectorName": "connector name",
                "itemTransactions": [
                {
                    "itemId": "BI101",
                    "paymentTransactionId": "4977",
                    "transactionStatus": 2,
                    "price": 0.3,
                    "paidPrice": 0.33000000,
                    "merchantCommissionRate": 10.00000000,
                    "merchantCommissionRateAmount": 0.03000000,
                    "iyziCommissionRateAmount": 0.00973500,
                    "iyziCommissionFee": 0.08850000,
                    "blockageRate": 10.00000000,
                    "blockageRateAmountMerchant": 0.03300000,
                    "blockageRateAmountSubMerchant": 0,
                    "blockageResolvedDate": "2016-03-28 09:27:14",
                    "subMerchantKey": "subMerchantKey",
                    "subMerchantPrice": 0,
                    "subMerchantPayoutRate": 0E-8,
                    "subMerchantPayoutAmount": 0,
                    "merchantPayoutAmount": 0.19876500,
                    "convertedPayout":
                    {
                        "paidPrice":0.33000000,
                        "iyziCommissionRateAmount":0.00973500,
                        "iyziCommissionFee":0.08850000,
                        "blockageRateAmountMerchant":0.03300000,
                        "blockageRateAmountSubMerchant":0E-8,
                        "subMerchantPayoutAmount":0E-8,
                        "merchantPayoutAmount":0.19876500,
                        "iyziConversionRate":0,
                        "iyziConversionRateAmount":0,
                        "currency":"TRY"
                    }
                },
                {
                    "itemId": "BI102",
                    "paymentTransactionId": "4978",
                    "transactionStatus": 2,
                    "price": 0.5,
                    "paidPrice": 0.55000000,
                    "merchantCommissionRate": 10.00000000,
                    "merchantCommissionRateAmount": 0.05000000,
                    "iyziCommissionRateAmount": 0.01622500,
                    "iyziCommissionFee": 0.14750000,
                    "blockageRate": 10.00000000,
                    "blockageRateAmountMerchant": 0.05500000,
                    "blockageRateAmountSubMerchant": 0,
                    "blockageResolvedDate": "2016-03-28 09:27:14",
                    "subMerchantKey": "subMerchantKey",
                    "subMerchantPrice": 0,
                    "subMerchantPayoutRate": 0E-8,
                    "subMerchantPayoutAmount": 0,
                    "merchantPayoutAmount": 0.33127500,
                    "convertedPayout":
                    {
                        "paidPrice":0.55000000,
                        "iyziCommissionRateAmount":0.01622500,
                        "iyziCommissionFee":0.14750000,
                        "blockageRateAmountMerchant":0.05500000,
                        "blockageRateAmountSubMerchant":0E-8,
                        "subMerchantPayoutAmount":0E-8,
                        "merchantPayoutAmount":0.33127500,
                        "iyziConversionRate":0,
                        "iyziConversionRateAmount":0,
                        "currency":"TRY"
                    }
                },
                {
                    "itemId": "BI103",
                    "paymentTransactionId": "4979",
                    "transactionStatus": 2,
                    "price": 0.2,
                    "paidPrice": 0.22000000,
                    "merchantCommissionRate": 10.00000000,
                    "merchantCommissionRateAmount": 0.02000000,
                    "iyziCommissionRateAmount": 0.00649000,
                    "iyziCommissionFee": 0.05900000,
                    "blockageRate": 10.00000000,
                    "blockageRateAmountMerchant": 0.02200000,
                    "blockageRateAmountSubMerchant": 0,
                    "blockageResolvedDate": "2016-03-28 09:27:14",
                    "subMerchantKey": "subMerchantKey",
                    "subMerchantPrice": 0,
                    "subMerchantPayoutRate": 0E-8,
                    "subMerchantPayoutAmount": 0,
                    "merchantPayoutAmount": 0.13251000,
                    "convertedPayout":
                    {
                        "paidPrice":0.22000000,
                        "iyziCommissionRateAmount":0.00649000,
                        "iyziCommissionFee":0.05900000,
                        "blockageRateAmountMerchant":0.02200000,
                        "blockageRateAmountSubMerchant":0E-8,
                        "subMerchantPayoutAmount":0E-8,
                        "merchantPayoutAmount":0.13251000,
                        "iyziConversionRate":0,
                        "iyziConversionRateAmount":0,
                        "currency":"TRY"
                    }
                }]
            }';

        $checkoutForm = CheckoutFormMapper::create($json)->jsonDecode()->mapCheckoutForm(new CheckoutForm());

        $this->assertNotEmpty($checkoutForm);
        $this->assertEquals(Status::FAILURE, $checkoutForm->getStatus());
        $this->assertEquals("10000", $checkoutForm->getErrorCode());
        $this->assertEquals("error message", $checkoutForm->getErrorMessage());
        $this->assertEquals("ERROR_GROUP", $checkoutForm->getErrorGroup());
        $this->assertEquals(Locale::TR, $checkoutForm->getLocale());
        $this->assertEquals("1458545234852", $checkoutForm->getSystemTime());
        $this->assertEquals("123456", $checkoutForm->getConversationId());
        $this->assertJson($checkoutForm->getRawResult());
        $this->assertJsonStringEqualsJsonString($json, $checkoutForm->getRawResult());
        $this->assertEquals("1.0", $checkoutForm->getPrice());
        $this->assertEquals("1.1", $checkoutForm->getPaidPrice());
        $this->assertEquals("1", $checkoutForm->getInstallment());
        $this->assertEquals("1", $checkoutForm->getPaymentId());
        $this->assertEmpty($checkoutForm->getPaymentStatus());
        $this->assertEquals("1", $checkoutForm->getFraudStatus());
        $this->assertEquals("10.00000000", $checkoutForm->getMerchantCommissionRate());
        $this->assertEquals("0.1", $checkoutForm->getMerchantCommissionRateAmount());
        $this->assertEquals("0.03245000", $checkoutForm->getIyziCommissionRateAmount());
        $this->assertEquals("0.29500000", $checkoutForm->getIyziCommissionFee());
        $this->assertEquals("CREDIT_CARD", $checkoutForm->getCardType());
        $this->assertEquals("MASTER_CARD", $checkoutForm->getCardAssociation());
        $this->assertEquals("Bonus", $checkoutForm->getCardFamily());
        $this->assertEquals("cardUserKey", $checkoutForm->getCardUserKey());
        $this->assertEquals("cardToken", $checkoutForm->getCardToken());
        $this->assertEquals("554960", $checkoutForm->getBinNumber());
        $this->assertEquals("B67832", $checkoutForm->getBasketId());
        $this->assertEquals(Currency::TL, $checkoutForm->getCurrency());
        $this->assertEquals("connector name", $checkoutForm->getConnectorName());

        $paymentItems = $checkoutForm->getPaymentItems();
        $this->assertNotEmpty($checkoutForm->getPaymentItems());
        $this->assertEquals(3, count($checkoutForm->getPaymentItems()));

        $paymentItem = $paymentItems[0];
        $this->assertEquals("BI101", $paymentItem->getItemId());
        $this->assertEquals("4977", $paymentItem->getPaymentTransactionId());
        $this->assertEquals("2", $paymentItem->getTransactionStatus());
        $this->assertEquals("0.3", $paymentItem->getPrice());
        $this->assertEquals("0.33000000", $paymentItem->getPaidPrice());
        $this->assertEquals("10.00000000", $paymentItem->getMerchantCommissionRate());
        $this->assertEquals("0.03000000", $paymentItem->getMerchantCommissionRateAmount());
        $this->assertEquals("0.00973500", $paymentItem->getIyziCommissionRateAmount());
        $this->assertEquals("0.08850000", $paymentItem->getIyziCommissionFee());
        $this->assertEquals("10.00000000", $paymentItem->getBlockageRate());
        $this->assertEquals("0.03300000", $paymentItem->getBlockageRateAmountMerchant());
        $this->assertEquals("0", $paymentItem->getBlockageRateAmountSubMerchant());
        $this->assertEquals("2016-03-28 09:27:14", $paymentItem->getBlockageResolvedDate());
        $this->assertEquals("subMerchantKey", $paymentItem->getSubMerchantKey());
        $this->assertEquals("0", $paymentItem->getSubMerchantPrice());
        $this->assertEquals("0E-8", $paymentItem->getSubMerchantPayoutRate());
        $this->assertEquals("0", $paymentItem->getSubMerchantPayoutAmount());
        $this->assertEquals("0.19876500", $paymentItem->getMerchantPayoutAmount());
        $this->assertNotEmpty($paymentItem->getConvertedPayout());
        $this->assertEquals("0.33000000", $paymentItem->getConvertedPayout()->getPaidPrice());
        $this->assertEquals("0.00973500", $paymentItem->getConvertedPayout()->getIyziCommissionRateAmount());
        $this->assertEquals("0.08850000", $paymentItem->getConvertedPayout()->getIyziCommissionFee());
        $this->assertEquals("0.03300000", $paymentItem->getConvertedPayout()->getBlockageRateAmountMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getBlockageRateAmountSubMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getSubMerchantPayoutAmount());
        $this->assertEquals("0.19876500", $paymentItem->getConvertedPayout()->getMerchantPayoutAmount());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRate());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRateAmount());
        $this->assertEquals(Currency::TL, $paymentItem->getConvertedPayout()->getCurrency());

        $paymentItem = $paymentItems[1];
        $this->assertEquals("BI102", $paymentItem->getItemId());
        $this->assertEquals("4978", $paymentItem->getPaymentTransactionId());
        $this->assertEquals("2", $paymentItem->getTransactionStatus());
        $this->assertEquals("0.5", $paymentItem->getPrice());
        $this->assertEquals("0.55000000", $paymentItem->getPaidPrice());
        $this->assertEquals("10.00000000", $paymentItem->getMerchantCommissionRate());
        $this->assertEquals("0.05000000", $paymentItem->getMerchantCommissionRateAmount());
        $this->assertEquals("0.01622500", $paymentItem->getIyziCommissionRateAmount());
        $this->assertEquals("0.14750000", $paymentItem->getIyziCommissionFee());
        $this->assertEquals("10.00000000", $paymentItem->getBlockageRate());
        $this->assertEquals("0.05500000", $paymentItem->getBlockageRateAmountMerchant());
        $this->assertEquals("0", $paymentItem->getBlockageRateAmountSubMerchant());
        $this->assertEquals("2016-03-28 09:27:14", $paymentItem->getBlockageResolvedDate());
        $this->assertEquals("subMerchantKey", $paymentItem->getSubMerchantKey());
        $this->assertEquals("0", $paymentItem->getSubMerchantPrice());
        $this->assertEquals("0E-8", $paymentItem->getSubMerchantPayoutRate());
        $this->assertEquals("0", $paymentItem->getSubMerchantPayoutAmount());
        $this->assertEquals("0.33127500", $paymentItem->getMerchantPayoutAmount());
        $this->assertNotEmpty($paymentItem->getConvertedPayout());
        $this->assertEquals("0.55000000", $paymentItem->getConvertedPayout()->getPaidPrice());
        $this->assertEquals("0.01622500", $paymentItem->getConvertedPayout()->getIyziCommissionRateAmount());
        $this->assertEquals("0.14750000", $paymentItem->getConvertedPayout()->getIyziCommissionFee());
        $this->assertEquals("0.05500000", $paymentItem->getConvertedPayout()->getBlockageRateAmountMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getBlockageRateAmountSubMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getSubMerchantPayoutAmount());
        $this->assertEquals("0.33127500", $paymentItem->getConvertedPayout()->getMerchantPayoutAmount());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRate());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRateAmount());
        $this->assertEquals(Currency::TL, $paymentItem->getConvertedPayout()->getCurrency());

        $paymentItem = $paymentItems[2];
        $this->assertEquals("BI103", $paymentItem->getItemId());
        $this->assertEquals("4979", $paymentItem->getPaymentTransactionId());
        $this->assertEquals("2", $paymentItem->getTransactionStatus());
        $this->assertEquals("0.2", $paymentItem->getPrice());
        $this->assertEquals("0.22000000", $paymentItem->getPaidPrice());
        $this->assertEquals("10.00000000", $paymentItem->getMerchantCommissionRate());
        $this->assertEquals("0.02000000", $paymentItem->getMerchantCommissionRateAmount());
        $this->assertEquals("0.00649000", $paymentItem->getIyziCommissionRateAmount());
        $this->assertEquals("0.05900000", $paymentItem->getIyziCommissionFee());
        $this->assertEquals("10.00000000", $paymentItem->getBlockageRate());
        $this->assertEquals("0.02200000", $paymentItem->getBlockageRateAmountMerchant());
        $this->assertEquals("0", $paymentItem->getBlockageRateAmountSubMerchant());
        $this->assertEquals("2016-03-28 09:27:14", $paymentItem->getBlockageResolvedDate());
        $this->assertEquals("subMerchantKey", $paymentItem->getSubMerchantKey());
        $this->assertEquals("0", $paymentItem->getSubMerchantPrice());
        $this->assertEquals("0E-8", $paymentItem->getSubMerchantPayoutRate());
        $this->assertEquals("0", $paymentItem->getSubMerchantPayoutAmount());
        $this->assertEquals("0.13251000", $paymentItem->getMerchantPayoutAmount());
        $this->assertNotEmpty($paymentItem->getConvertedPayout());
        $this->assertEquals("0.22000000", $paymentItem->getConvertedPayout()->getPaidPrice());
        $this->assertEquals("0.00649000", $paymentItem->getConvertedPayout()->getIyziCommissionRateAmount());
        $this->assertEquals("0.05900000", $paymentItem->getConvertedPayout()->getIyziCommissionFee());
        $this->assertEquals("0.02200000", $paymentItem->getConvertedPayout()->getBlockageRateAmountMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getBlockageRateAmountSubMerchant());
        $this->assertEquals("0E-8", $paymentItem->getConvertedPayout()->getSubMerchantPayoutAmount());
        $this->assertEquals("0.13251000", $paymentItem->getConvertedPayout()->getMerchantPayoutAmount());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRate());
        $this->assertEquals("0", $paymentItem->getConvertedPayout()->getIyziConversionRateAmount());
        $this->assertEquals(Currency::TL, $paymentItem->getConvertedPayout()->getCurrency());
    }
}
