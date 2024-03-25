<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult)) {
    return;
}

?>
<ul class="list-inside  bullet-list-item">
	<?foreach($arResult as $itemID => $arColumns):?>     <!-- first level-->
        <li
            class="text-gray-600 hover:text-orange
                <?if($arResult[$itemID]['PARAMS']['COLOUR']):?>text-<?=$arResult[$itemID]['PARAMS']['COLOUR']?>-600<?endif?>
                <?if($arResult[$itemID]["SELECTED"]):?>text-orange cursor-default<?endif?>"
        >
			<a href="<?=$arResult[$itemID]["LINK"]?>">
				<?=$arResult[$itemID]["TEXT"]?>
			</a>
		</li>
	<?endforeach;?>
</ul>
<div style="clear: both;"></div>
