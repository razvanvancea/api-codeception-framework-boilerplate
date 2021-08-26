<?php

use \Codeception\Util\HttpCode;
use Helper\Header;
use Helper\Faker;

class PatchPaymentsCest
{
    /**
     * Send PATCH request to the /api/payments/id endpoint
     * @throws Exception
     */
    public function patchPaymentTest(ApiTester $I){
        $faker = Faker::create();

        $randomAmountValue = $faker->randomNumber();

        $postRequestBody = array(
            'paymentId' => "3fa85f64-5717-4562-b3fc-2c963f66afa7",
            'merchantId' => "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            'merchantOrderId' => "merchantStringOrderId",
            'amount' => $randomAmountValue,
            'cardToken' => "stringCardToken",
            'orderDescription' => "Order description value"
        );

        $patchRequestBody = array(
            'terminal' => "terminal",
            'trtype' => 5,
            'order' => "my order",
            'amount' => 50,
            'currency' => "euro",
            'desc' => "abc",
            'action' => 2,
            'rc' => 10,
            'message' => "This is a message.",
            "rrn" => 3,
            "int_ref" => "1",
            "approval" => 1,
            "timestamp" => "2021-08-24T12:03:14.923Z",
            "nonce" => "string",
            "p_sign" => "8fbb3cb2f50ec3803ee4d6e05d908f9c4b8a3576"
        );

        $I->haveHttpHeader(Header::CONTENT_TYPE, 'application/json');
        $I->sendPost('/api/payments', $postRequestBody);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $paymentId = $I->grabDataFromResponseByJsonPath('id')[0];

        $I->sendPatch('/api/payments/' . $paymentId, $patchRequestBody);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
        $I->seeInDatabase('PaymentSteps', array('Amount' => $randomAmountValue, 'ReferenceId' => 3, 'TransactionResponseCode' => 10, 'TransactionResponseMessage' => 'This is a message.'));
    }

    /**
     * Send invalid path id on PATCH /api/payments/id endpoint
     * @throws Exception
     */
    public function patchPaymentInvalidPathIdTest(ApiTester $I){
        $patchRequestBody = array(
            'terminal' => "terminal",
            'trtype' => 5,
            'order' => "my order",
            'amount' => 50,
            'currency' => "euro",
            'desc' => "abc",
            'action' => 2,
            'rc' => 10,
            'message' => "This is a message.",
            "rrn" => 3,
            "int_ref" => "1",
            "approval" => 1,
            "timestamp" => "2021-08-24T12:03:14.923Z",
            "nonce" => "string",
            "p_sign" => "8fbb3cb2f50ec3803ee4d6e05d908f9c4b8a3576"
        );

        $I->haveHttpHeader(Header::CONTENT_TYPE, 'application/json');
        $I->sendPatch('/api/payments/c8800776-cc3b-485b-2bb6-08d96700b112', $patchRequestBody);
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
    }

    /**
     * Send invalid "p_sign" param as PATCH /api/payments/id endpoint
     * @throws Exception
     */
    public function patchPaymentInvalidPSignTest(ApiTester $I){
        $postRequestBody = array(
            'paymentId' => "3fa85f64-5717-4562-b3fc-2c963f66afa7",
            'merchantId' => "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            'merchantOrderId' => "merchantStringOrderId",
            'amount' => 1500,
            'cardToken' => "stringCardToken",
            'orderDescription' => "Order description value"
        );

        $patchRequestBody = array(
            'terminal' => "terminal",
            'trtype' => 5,
            'order' => "my order",
            'amount' => 50,
            'currency' => "euro",
            'desc' => "abc",
            'action' => 2,
            'rc' => 10,
            'message' => "This is a message.",
            "rrn" => 3,
            "int_ref" => "1",
            "approval" => 1,
            "timestamp" => "2021-08-24T12:03:14.923Z",
            "nonce" => "string",
            "p_sign" => "8fbb3cb2f50ec3803ee4d6e05d908f9c4b8a0000"
        );

        $I->haveHttpHeader(Header::CONTENT_TYPE, 'application/json');
        $I->sendPost('/api/payments', $postRequestBody);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $paymentId = $I->grabDataFromResponseByJsonPath('id')[0];

        $I->sendPatch('/api/payments/' . $paymentId, $patchRequestBody);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
    }
}
