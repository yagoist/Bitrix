<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

?>

<form id="form" method="post" enctype="multipart/form-data">
    <div class="mt-8 max-w-md">
        <div class="grid grid-cols-1 gap-6">
            <div class="block">
                <input id="IBLOCK_ID"
                       type="hidden"
                       name="IBLOCK_ID"
                       value="<?= $arParams[0]['IBLOCK_ID'][0]?>"
                >
                <label for="NAME"
                       class="text-gray-700 font-bold"
                >
                    <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_TITLE") ?>
                </label>
                <input id="NAME"
                       type="text"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       placeholder=""
                       name="NAME"
                >
            </div>
            <div class="block">
                <label
                        for="RESPONSIBLE"
                        class="text-gray-700 font-bold"
                >
                    <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_CUSTOMER") ?>
                </label>
                <select
                    id="RESPONSIBLE"
                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="RESPONSIBLE"
                >
                    <?php foreach ($arResult['USERS'] as $user) { ?>
                        <option value="<?=$user['USER_ID']?>">
                            <?=$user['FULL_NAME'] . ' ' . $user['WORK']?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?= \Bitrix\Main\UI\FileInput::createInstance(array(
                "name" => "PROPERTY_FILE",
                "description" => true,
                "upload" => true,
                "allowUpload" => "F",
                "medialib" => false,
                "fileDialog" => true,
                "cloud" => false,
                "delete" => true,
                "maxCount" => 1
                ))->show($showFiles);
            ?>
            <div class="block">
                <label
                    for="ORIGINAL_LANGUAGE"
                    class="text-gray-700 font-bold"
                >
                    <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_ORIGINAL_LANGUAGE") ?>
                </label>
                <input
                    id="ORIGINAL_LANGUAGE"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder=""
                    name="ORIGINAL_LANGUAGE"
                >
            </div>
            <div class="block">
                <label
                    for="TRANSLATION_LANGUAGE"
                    class="text-gray-700 font-bold"
                >
                    <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_TRANSLATION_LANGUAGE") ?>
                </label>
                <input
                    id="TRANSLATION_LANGUAGE"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder=""
                    name="TRANSLATION_LANGUAGE"
                >
            </div>
            <div class="block">
                <label
                    for="EXECUTION_DATE"
                    class="text-gray-700 font-bold"
                >
                    <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_EXECUTION_DATE") ?>
                </label>
                <input
                    id="EXECUTION_DATE"
                    name="EXECUTION_DATE"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    onclick="BX.calendar({node: this, field: this, bTime: false});"
                >
            </div>
            <div class="block">
                <button
                    id="submit"
                    onclick="addFields()"
                    class="inline-block bg-orange hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded"
                >
                    Сохранить
                </button>
                <button class="inline-block bg-gray-400 hover:bg-opacity-70 focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Отменить
                </button>
            </div>
        </div>
    </div>
</form>

