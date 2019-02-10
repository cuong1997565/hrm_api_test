<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class DateExpirationRule implements Rule
{
    protected $date_sign;
    protected $date_effective;

    public function __construct($date_sign, $date_effective){
        $this->date_sign        = $date_sign;
        $this->date_effective   = $date_effective;
    }

     /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute, $value)
    {
            if (!$value || !$this->date_sign || !$this->date_effective) {
                return true;
            } else {
                $validator = Validator::make(
                      ['date_expiration' => $value],
                      ['date_expiration' => 'date|after:'.$this->date_sign.'|after:'.$this->date_effective]
                );
                return $validator->passes();
            }
    }

      /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ngày hết hạn không hợp lệ';
    }
}