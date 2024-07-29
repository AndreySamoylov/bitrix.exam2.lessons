<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
?>

<?php foreach ($arResult["SECTIONS"] as $arSection) { ?>
    <h4><?=$arSection["NAME"]?></h4>
    <ul>
        <?php foreach ($arSection["ITEMS"] as $arItem) { ?>
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
            </li>
        <?php  } ?>
    </ul>
<?php  } ?>
