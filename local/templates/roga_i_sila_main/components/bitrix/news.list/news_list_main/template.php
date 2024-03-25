<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

?>

<section class="news-block-inverse px-6 py-4">
    <div>
        <p class="inline-block text-3xl text-white font-bold mb-4">
            <?=Loc::getMessage('BLOCK_NEWS')?>
        </p>
        <span class="inline-block text-gray-200 pl-1">
            /
            <a href="<?=($arResult['ITEMS'][0]['LIST_PAGE_URL'])?>"
               class="inline-block pl-1 text-gray-200 hover:text-orange">
                <b>
                    <?=Loc::getMessage('BLOCK_NEWS_ALL')?>
                </b>
            </a>
        </span>
    </div>
    <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
        <?php foreach ($arResult['ITEMS'] as $item) {?>
        <div class="w-full flex">
            <div class="h-48 lg:h-auto w-32 sm:w-60 lg:w-32 xl:w-48 flex-none text-center overflow-hidden">
                <a class="block w-full h-full hover:opacity-75"
                   href="<?=$item["DETAIL_PAGE_URL"]?>">
                    <img class="bg-white bg-opacity-25 w-full h-full object-contain"
                         src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>"
                         width="<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>"
                         height="<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>"
                         alt="<?=$item["PREVIEW_PICTURE"]["ALT"]?>"
                         title="<?=$item["PREVIEW_PICTURE"]["TITLE"]?>"
                         style="float:left"
                    >
                </a>
            </div>
            <div class="px-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <div class="text-white font-bold text-xl mb-2">
                        <a class="hover:text-orange" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item['NAME']?></a>
                    </div>
                    <p class="text-gray-300 text-base">
                        <a class="hover:text-orange" href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item['PREVIEW_TEXT']?></a>
                    </p>
                </div>
                <div class="flex items-center">
                    <p class="text-sm text-gray-400 italic"><?=$item['DISPLAY_ACTIVE_FROM']?></p>
                </div>
            </div>
        </div>
        <?php }?>
        <div style="clear:both"></div>
    </div>
</section>



