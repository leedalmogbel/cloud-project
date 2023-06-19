<?php

namespace App\Validators;

use App\Models\Stable as StableModel;
use App\Exceptions\FieldException;
use App\Exceptions\MsgException;
use App\Validators\Stable as StableValidator;

class Stable extends StableModel {
    use Base;
    
    const MODEL_NAME = 'Stable';
    const SERVICE_MODEL = 'App\Models\Stable';

    protected $requiredFields = [
        'name' => 'Stable Name',
        'stable_no' => 'Stable No',
        'owner_name' => 'Owner Name',
        'owner_eid' => 'Owner EID',
        'owner_eid_photo' => 'Owner EID Photo',
        'owner_mobile' => 'Owner Mobile',
        'total_horses' => 'Total Horse',
        'user_id' => 'User',
    ];
    
    protected $modelShouldExist = [
        'user_id' => [
            'User',
            \App\Services\User::class,
        ],
    ];

    public static function saveForm(StableModel $stable) {
        $errors = [];

        // required fields
        $required = [
            'name' => 'Stable Name',
            'stable_no' => 'Stable No',
            'owner_name' => 'Owner Name',
            'owner_eid' => 'Owner EID',
            'owner_eid_photo' => 'Owner EID Photo',
            'owner_mobile' => 'Owner Mobile',
            'total_horses' => 'Total Horse',
            'user_id' => 'User',
        ];

        // validate required fields
        foreach ($required as $field => $label) {
            if (!$stable->$field || !trim($stable->$field)) {
                $errors[$field] = "$label is required";
            }
        }


        if (!empty($errors)) {
            throw new FieldException(json_encode($errors));
        }

        // unique values
        // $uniques = [
        //     'username' => 'Username',
        //     'email' => 'Email Address',
        //     'phone' => 'Phone/Mobile No.'
        // ];

        // // validate unique values
        // foreach ($uniques as $field => $label) {
        //     $exist = StableModel::where($field, $stable->$field)->first();
        //     if (!empty($exist)) {
        //         $errors[$field] = "$label already exist";
        //     }
        // }

        if (!empty($errors)) {
            throw new FieldException(json_encode($errors));
        }

        return true;

    }
}
