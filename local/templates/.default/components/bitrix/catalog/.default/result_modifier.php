<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->SetViewTarget('catalog_materials');
$arFilter = ['IBLOCK_ID' =>  IBLOCK_PRODUCTS];
$arGroupBy = ['PROPERTY_MATERIAL'];
$arSelect = ['NAME','PROPERTY_MATERIAL'];
$result = CIBlockElement::GetList([], $arFilter, $arGroupBy, false, $arSelect);
while ($item = $result->Fetch()){
    $arResult['MATERIALS'][] = ['NAME' => $item["PROPERTY_MATERIAL_VALUE"], 'CNT' => $item["CNT"]];
}
?>
<ul>
<?
foreach ($arResult['MATERIALS'] as $material){
    echo '<li>'.  $material['NAME'] . ' - ' . $material['CNT'] . '</li>';
}
?>
</ul>
<?
$this->EndViewTarget();

