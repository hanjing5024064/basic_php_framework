<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 2018/7/12
 * Time: 9:51 PM
 */
namespace App\Core\Utility;

use App\Core\Interfaces\ValidatorInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator implements ValidatorInterface
{
    protected $errors = [];

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try{
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            }catch(NestedValidationException $e){
                $this->errors[$field] = $e->getMessages();

            }
        }

        $_SESSION['errors'] = $this->errors;

        return empty($this->errors);
    }
}