<?php
use \Codeception\Util\HttpCode;
use data\GetMockyData;

class GetMockyCest
{
    /**
     * URL: https://run.mocky.io/v3/a23efab4-c98b-4f59-8e8b-7a42921d471b
     */
    public function getDepartments(ApiTester $I) {
        $I->sendGet('/v3/a23efab4-c98b-4f59-8e8b-7a42921d471b');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType(GetMockyData::getDepartmentsStructureResponse);
//        $I->seeResponseMatchesJsonType(['id' => 'integer', 'name'=>'string'], '$.data[*]');
        $I->seeResponseMatchesJsonType(GetMockyData::getDepartmentsStructureResponseDataArray, '$.data[*]');
    }
}
