<?php

/**
 * IWPhoneNumberValidator validates that a Brazilian phone number is valid.
 * 
 * Credits to Fausto Gonçalves Cintra regular expressions used in the validation.
 * http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 * @since 1.1
 */
class PhoneNumberValidator extends CValidator {

    /**
     * Indicates whether only mobile numbers will be validated.
     * Defaults to true.
     * @var boolean
     */
    public $onlyMobileNumbers = false;

    /**
     * Indicates whether the attribute value can be null or empty.
     * Defaults to true.
     * @var boolean
     */
    public $allowEmpty = true;

    /**
     * Indicates whether the mask of the phone number will be considered in the validation.
     * Mask in the format will be accepted: (99) 9999-9999 or (99) 99999-9999 
     * Defaults to false.
     * @var boolean
     */
    public $validateWithMask = false;

    /**
     * Contains custom validation message.
     * @var string
     */
    public $customMessage;

    /**
     * Contains the required regular expression to validate phone number without mask.
     * @var string
     */
    private $phoneWithoutMaskPattern = '/([1-9][1-9])[2-9][0-9]{3}[0-9]{4}/';

    /**
     * Contains the regular expression needed for validation of mobile phone number with 10 digits and without mask.
     * @var string
     */
    private $mobilePhoneWithoutMaskPattern10digits = '/([1-9][1-9])[6-9]{1}[0-9]{3}[0-9]{4}/';

    /**
     * Contains the regular expression needed for validation of mobile phone number with 11 digits and without mask.
     * @var string
     */
    private $mobilePhoneWithoutMaskPattern11digits = '/([1][1]|[1][2]|[1][3]|[1][4]|[1][5]|[1][6]|[1][7]|[1][8]|[1][9]|[2][1]|[2][2]|[2][4]|[2][7]|[2][8])[9]{1}[6-9]{1}[0-9]{3}[0-9]{4}/';

    /**
     * Contains the required regular expression to validate phone number with mask.
     * @var string
     */
    private $phoneWithMaskPattern = '/\(([1-9][1-9])\) [2-9][0-9]{3}-[0-9]{4}/';

    /**
     * Contains the regular expression needed for validation of mobile phone number with mask.
     * @var string
     */
    private $mobilePhoneWithMaskPattern = '/\(([1-9][1-9])\) [6-9][0-9]{3}-[0-9]{4}|\(([1][1]|[1][2]|[1][3]|[1][4]|[1][5]|[1][6]|[1][7]|[1][8]|[1][9]|[2][1]|[2][2]|[2][4]|[2][7]|[2][8])\) [9][6-9][0-9]{3}-[0-9]{4}/';

    /**
     * Validates a single attribute.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }
        if (!$this->validatePhoneNumber($value)) {
            $message = $this->customMessage !== null ? $this->customMessage : Yii::t('yii', '{attribute} is not a valid phone number.');
            if ($this->onlyMobileNumbers) {
                $message = $this->customMessage !== null ? $this->customMessage : Yii::t('yii', '{attribute} is not a valid mobile phone number.');
            }
            $this->addError($object, $attribute, $message);
        }
    }

    /**
     * Validates a phone number according to the rules.
     * @param string $value Phone number to be validated.
     * @return boolean
     */
    public function validatePhoneNumber($value) {
        if ($this->onlyMobileNumbers) {
            if ($this->validateWithMask) {
                return (preg_match($this->mobilePhoneWithMaskPattern, "$value"));
            } else {
                if (strlen($value) == 10) { //validate phone number with 10 digits
                    return (preg_match($this->mobilePhoneWithoutMaskPattern10digits, "$value"));
                } elseif (strlen($value) == 11) { //validate phone number with 11 digits
                    return (preg_match($this->mobilePhoneWithoutMaskPattern11digits, "$value"));
                } else {
                    return FALSE;
                }
            }
        } else {
            if ($this->validateWithMask) {
                return (preg_match($this->phoneWithMaskPattern, "$value"));
            } else {
                return (preg_match($this->phoneWithoutMaskPattern, "$value"));
            }
        }
    }

}
