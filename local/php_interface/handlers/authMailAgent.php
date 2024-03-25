<?php

\Bitrix\Main\EventManager::getInstance()->addEventHandlerCompatible(
    'main',
    'OnAfterUserAuthorize',
    function ($userFields) {
       \Bitrix\Main\Mail\Event::Send([
            'EVENT_NAME' => 'USER_AUTHORIZATION',
            'LID' => SITE_ID,
            'C_FIELDS' => [
                'USER_ID'   => $userFields['user_fields']['ID'],
                'EMAIL'     => $userFields['user_fields']['EMAIL'],
                'MESSAGE'   => '',
                'NAME'      => $userFields['user_fields']['NAME'],
                'LAST_NAME' => $userFields['user_fields']['LAST_NAME'],
                'TIME'      => date("Y.m.d H:i:s"),
            ]
        ]);
    }
);
