<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

?>

<div class="">
    <table cellpadding="10" cellspacing="0" border="0" width="100%">
	    <tr>
            <td>
                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <thead>
                    <tr valign="top" id="<?=$this->GetEditAreaId('iblock_' . $arResult['ID']);?>">
                        <td colspan="7"><a href="<?=$arResult["LIST_PAGE_URL"]?>"><?=$arResult["NAME"]?></a></td>
                    </tr>
                    <tr>
                        <td class="border"> <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_TITLE") ?>  </td>
                        <td class="border"> <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_RESPONSIBLE") ?>  </td>
                        <td class="border"> <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_ORIGINAL_LANGUAGE") ?>  </td>
                        <td class="border"> <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_TRANSLATION_LANGUAGE") ?>  </td>
                        <td class="border"> <?= GetMessage("TRANSLATION_ORDERS_LIST_TABLE_HEAD_FIELD_EXECUTION_DATE") ?>  </td>
                    </tr>
                    </thead>
                    <?php
                    foreach ($arResult['ITEMS'] as $arItem) { ?>
                        <tr valign="top" id="<?=$arItem['ID']?>">
                            <td class="border">
                                <?=$arItem["NAME"]?>&nbsp;
                            </td>
                           <td class="border">
                                <?=$arItem['PROPERTY_RESPONSIBLE_FULL_NAME']?>
                            </td>
                            <td class="border">
                                <?=$arItem['PROPERTY_ORIGINAL_LANGUAGE_VALUE']?>&nbsp;
                            </td>
                            <td class="border">
                                <?= implode('<br>', $arItem['PROPERTY_TRANSLATION_LANGUAGE_VALUE'])?>
                            </td>
                            <td class="border">
                                <?=$arItem['PROPERTY_EXECUTION_DATE_VALUE']?>
                            </td>
                            <td class="border">
                                <?=$arItem['PROPERTY_EXECUTION_STATUS_VALUE']?>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </td>
	    </tr>
    </table>
</div>