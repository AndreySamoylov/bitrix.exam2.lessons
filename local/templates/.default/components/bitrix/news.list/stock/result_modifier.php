<?php

foreach($arResult["ITEMS"] as &$arItem){
    $arItem["PROPERTY_LINK_DETAIL_PICTURE"] = CFile::ResizeImageGet(
        $arItem["PROPERTY_LINK_DETAIL_PICTURE"],
        array('width' => $arParams["PICTURE_WIDTH"], 'height' => $arParams["PICTURE_HEIGHT"]),
        BX_RESIZE_IMAGE_EXACT,
        true
    );
}
