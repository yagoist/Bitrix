<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Bizproc\Activity\BaseActivity;
use Bitrix\Bizproc\FieldType;
class CBPOutSourcePrice extends CBPActivity
{

    public function __construct($name)
    {
        $this->arProperties = [
            'outsorceprice' => Api::loadPrice()
        ];

        $this->setPropertiesTypes(
            [
                'outsorceprice' => [
                    'Type' => FieldType::INT
                ]
            ]
        );
    }
}