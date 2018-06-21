<?php

namespace App\Helpers;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

/**
 * Created by PhpStorm.
 * User: rcatalano
 * Date: 6/21/2018
 * Time: 12:01 PM
 */

class Validator
{

    private $validateRequest;

    /**
     * Validator constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->validateRequest = $request;
    }

    /**
     * @return mixed
     */
    public function validate()
    {
        $validator = Validation::createValidator();
        foreach ($this->validateRequest->request->all() as $param) {
            $violations = $validator->validate($param, array(
                new NotBlank(),
            ));
            if (0 !== count($violations)) {
                foreach ($violations as $violation) {
                    return $violation->getMessage();
                }
            }
        }

        return false;
    }
}

