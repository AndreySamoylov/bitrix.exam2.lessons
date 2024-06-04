<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
	$().ready(function(){
		$(function(){
			$('#slides').slides({
				preload: false,
				generateNextPrev: false,
				autoHeight: true,
				play: 4000,
				effect: 'fade'
			});
		});
	});
</script>
<? $APPLICATION->AddHeadScript(dirname(__FILE__) . '/jquery-1.8.2.min.js'); ?>
<? $APPLICATION->AddHeadScript(dirname(__FILE__) . '/slides.min.jquery.js'); ?>
<div class="sl_slider" id="slides">
	<div class="slides_container">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<div>
			<div>
				<?if(is_array($arItem["PROPERTY_LINK_DETAIL_PICTURE"])){ ?>
				    <img src="<?=$arItem["PROPERTY_LINK_DETAIL_PICTURE"]["src"]?>" alt="" />
				<? } ?>
				<h2><a href="<?=$arItem["PROPERTY_LINK_DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
				<p><?echo $arItem["PROPERTY_LINK_PREVIEW_TEXT"];?></p>
				<p><?echo $arItem["PROPERTY_LINK_NAME"] . ' всего за ' . $arItem['PROPERTY_LINK_PROPERTY_PRICE_VALUE'] . ' руб';?></p>
				<a href="<?=$arItem["PROPERTY_LINK_DETAIL_PAGE_URL"]?>" class="sl_more">Подробнее &rarr;</a>
			</div>
		</div>
		<?endforeach;?>
	</div>
</div>

