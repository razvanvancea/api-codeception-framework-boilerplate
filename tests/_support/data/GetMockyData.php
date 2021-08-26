<?php

namespace data;

/**
 * Class GetMockyData
 * @package _support\data
 * This file contains datasets used by the test suite - GetMockyCest.php
 */
class GetMockyData
{
    /**
     * Used by getDepartments Test
     */
    const getDepartmentsStructureResponse = array(
        'error' => 'string|null',
//        'data' => array(
//            'id' => 'integer',
//            'name' => 'string',
//            'departmentCode' => 'string',
//            'coordinator' => 'string|null',
//            'immediateUpperLevel' => 'string|null'
//        ),
        'data' => 'array',
        'metadata' => array(
            'prev' => 'boolean',
            'next' => 'boolean',
            'count' => 'integer'
        )
    );

    /**
     * Used by getDepartments Test
     */
    const getDepartmentsBriefStructureResponse = array(
        'error' => 'string|null',
        'data' => 'array',
        'metadata' => 'array'
    );

    const getDepartmentsStructureResponseDataArray = array(
            'id' => 'integer:>0:<1000', // asserts integer values between [1,999]
            'name' => 'string',
            'departmentCode' => 'string',
            'coordinator' => 'array|null',
            'immediateUpperLevel' => 'string|null'
        );
}

// JSON Response Example
//
//{
//    "error": null,
//    "data": [
//        {
//            "id": 1,
//            "name": "Human Resources",
//            "departmentCode": "HR",
//            "coordinator": null,
//            "immediateUpperLevel": null
//        },
//        {
//            "id": 2,
//            "name": "Quality Assurance",
//            "departmentCode": "QA",
//            "coordinator": {
//                "id": "2e284b25-e757-11e8-aa26-08002732ed09",
//                "displayName": "Mihai IONESCU",
//                "user": null,
//                "status": 4
//            },
//            "immediateUpperLevel": null
//        }
//    ],
//    "metadata": {
//        "prev": false,
//        "next": false,
//        "count": 7
//    }
//}
