<?php

use data\PostPaymentsData;
use \Codeception\Util\HttpCode;
use \Codeception\Example;
use Helper\Header;
use Helper\Faker;

class PostPaymentsCest
{
    /**
     * @dataProvider providePaymentData
     * Send a POST request to the /api/payments endpoint
     */
    public function postPaymentTest(ApiTester $I, Example $example){
        $requestBody = array(
            'paymentId' => $example['paymentId'],
            'merchantId' => $example['merchantId'],
            'merchantOrderId' => $example['merchantOrderId'],
            'amount' => $example['amount'],
            'cardToken' => $example['cardToken'],
            'orderDescription' => $example['orderDescription']
        );

        $I->haveHttpHeader(Header::CONTENT_TYPE, 'application/json');
        $I->sendPost('/api/payments', $requestBody);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(PostPaymentsData::postPaymentTestStructureResponse);
    }

    /**
     * @dataProvider providePaymentInvalidData
     * Send a POST request to the /api/payments endpoint, with invalid data types for parameters
     */
    public function postInvalidParamsPaymentTest(ApiTester $I, Example $example){
        $requestBody = array(
            'paymentId' => $example['paymentId'],
            'merchantId' => $example['merchantId'],
            'merchantOrderId' => $example['merchantOrderId'],
            'amount' => $example['amount'],
            'cardToken' => $example['cardToken'],
            'orderDescription' => $example['orderDescription']
        );

        $I->haveHttpHeader(Header::CONTENT_TYPE, 'application/json');
        $I->sendPost('/api/payments', $requestBody);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
    }

    protected function providePaymentData(): array
    {
        $faker = Faker::create();
        return [
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => "string", "amount" => 0, "cardToken" => "string", "orderDescription" => "string"],
           ];
    }

    protected function providePaymentInvalidData(): array
    {
        $faker = Faker::create();
        return [
            ['paymentId' => 'notok', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => "string", "amount" => 0, "cardToken" => "string", "orderDescription" => "string"],
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => 0, "merchantOrderId" => "string", "amount" => 0, "cardToken" => "string", "orderDescription" => "string"],
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => 11, "amount" => 0, "cardToken" => "string", "orderDescription" => "string"],
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => "string", "amount" => "lorem ipsum", "cardToken" => "string", "orderDescription" => "string"],
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => "string", "amount" => 0, "cardToken" => 11, "orderDescription" => "string"],
            ['paymentId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', 'merchantId' => '3fa85f64-5717-4562-b3fc-2c963f66afa6', "merchantOrderId" => "string", "amount" => 0, "cardToken" => "string", "orderDescription" => 11]
        ];
    }
}
