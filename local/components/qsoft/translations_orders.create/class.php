<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var CBitrixComponent $this */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
    Bitrix\Main,
    Bitrix\Iblock,
    Bitrix\Main\Context,
    Bitrix\Main\Application;

class CreateTranslateOrder extends \CBitrixComponent implements \Bitrix\Main\Engine\Contract\Controllerable
{
    private string $error = '';

    public function configureActions()
    {
        return [];
    }

    protected function getUsers()
    {
        $order = ['sort' => 'asc'];
        $tmp = 'sort';
        $users = CUser::GetList($order, $tmp);
        while ($user = $users->getNext()) {
            $userFields['FULL_NAME'] = $user['LAST_NAME'] . ' ' . $user['NAME'] . ' ' . $user['SECOND_NAME'];
            $userFields['WORK'] = $user['WORK_POSITION'] . ' ' . $user['WORK_DEPARTMENT	'] . ' ' . $user['WORK_PHONE'];
            $userFields['USER_ID'] = $user['ID'];
            $this->arResult['USERS'][] = $userFields;
        }
    }
    public function submitFormAction()
    {
        $request = (Context::getCurrent()->getRequest()->getPostList()->toArray());

        $file = CIBlOck::MakeFileArray(
            $_POST['PROPERTY_FILE']
        );

        if ($this->ValidateForm($request)) {

            $element = new CIBlockElement;

            $properties = array(
                "RESPONSIBLE" => $request['RESPONSIBLE'],
                "ORIGINAL_LANGUAGE" => $request['ORIGINAL_LANGUAGE'],
                "TRANSLATION_LANGUAGE" => $request['TRANSLATION_LANGUAGE'],
                "EXECUTION_DATE" => $request['EXECUTION_DATE'],
                'TRANSLATION_FILE' => CFile::SaveFile($file, '/translations/', false, false)
            );

            $fields = [
                'IBLOCK_ID' => $request['IBLOCK_ID'],
                'NAME' => $request['NAME'],
                'ACTIVE' => 'Y',
                'PROPERTIES' => $properties
            ];

            try {
                $elementId = $element->Add($fields);
                CIBlockElement::setPropertyValues(
                    $elementId,
                    $fields['IBLOCK_ID'],
                    $properties
                );
            } catch (Exception $exception) {
                return $exception->getMessage();
            }
            return true;
        }
        return [false, $this->error];
    }

    private function ValidateForm($data)
    {
        if ($data['RESPONSIBLE'] === ''
            || gettype($data['RESPONSIBLE']) !== 'string'
        ) {
            $this->error = 'RESPONSIBLE';
            return false;
        }

        if ($data['ORIGINAL_LANGUAGE'] === ''
            || gettype($data['ORIGINAL_LANGUAGE']) !== 'string'
        ) {
            $this->error = 'ORIGINAL_LANGUAGE';
            return false;
        }

        if ($data['TRANSLATION_LANGUAGE'] === ''
            || gettype($data['TRANSLATION_LANGUAGE']) !== 'string'
        ) {
            $this->error = 'TRANSLATION_LANGUAGE';
            return false;
        }

        if ($data['EXECUTION_DATE'] === ''
            || gettype($data['EXECUTION_DATE']) !== 'string'
        ) {
            $this->error ='EXECUTION_DATE';
            return false;
        }

        if ($data['IBLOCK_ID'] === ''
            || gettype($data['IBLOCK_ID']) !== 'string'
        ) {
            $this->error ='IBLOCK_ID';
            return false;
        }

        if ($data['NAME'] === ''
            || gettype($data['NAME']) !== 'string'
        ) {
            $this->error ='NAME';
            return false;
        }

        $fileExtension = pathinfo($_POST['PROPERTY_FILE']['name'])['extension'];


        if (!in_array($fileExtension, ['doc', 'docx', 'pdf', 'xlsx'], true)
        ) {
            $this->error = 'INPUT_FILE';
            return false;
        }

        return true;
    }
    public function executeComponent()
    {
        $this->getUsers();
        $this->includeComponentTemplate();
    }

}
