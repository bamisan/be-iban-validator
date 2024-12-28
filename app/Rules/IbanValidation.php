<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IbanValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       
        if (!$this->checkIban($value)) {

            $fail("The {$attribute} is invalid.");

        }
        
    }

    private function checkIban($iban)
    {
        if (strlen($iban) < 5)
            return false;

        $iban = strtolower(str_replace(' ', '', $iban));

        $countries = config('iban.countries');
        $chars = config('iban.chars');

        if (array_key_exists(substr($iban, 0, 2), $countries) && strlen($iban) == $countries[substr($iban, 0, 2)]) {

            $movedChar = substr($iban, 4) . substr($iban, 0, 4);
            $movedCharArray = str_split($movedChar);

            $newString = '';

            foreach ($movedCharArray as $key => $value) {
                
                if (!is_numeric($movedCharArray[$key])) {

                    if (!isset($chars[$movedCharArray[$key]]))
                        return false;

                    $movedCharArray[$key] = $chars[$movedCharArray[$key]];

                }

                $newString .= $movedCharArray[$key];

            }
            

            if (bcmod($newString, '97') == 1) {
                return true;
            }
        }

        return false;
    }
}
