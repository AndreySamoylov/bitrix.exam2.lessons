<?
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("CIBLockHandler", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler('iblock', 'OnBeforeIBlockElementDelete', Array("CIBLockHandler", "OnBeforeIBlockElementDeleteHandler"));
class CIBLockHandler
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    public static function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        /*Если деактивируется элемент, созданный меньше, чем 3 дня назад, то отменять деактивацию */
        if($arFields['IBLOCK_ID'] == IBLOCK_NEWS && $arFields['ACTIVE'] == 'N'){
            $activeFrom = MakeTimeStamp($arFields['ACTIVE_FROM'], 'DD.MM.YYYY');
            $threeDayAgo = time() - 86400 * 3;
            // Новость создана меньше, ем три дня назад
            if($activeFrom > $threeDayAgo){
                $arFields['ACTIVE'] = 'Y';
                global $APPLICATION;
                $APPLICATION->throwException("Ошибка удаления: свежая новость");
                return false;
            }
        }
    }

    public static function OnBeforeIBlockElementDeleteHandler($id)
    {
        if (CModule::IncludeModule("iblock")) {
            $result = CIBlockElement::GetByID($id);
            if ($arResult = $result->Fetch()) {
                // Запрет на удаление товара из каталога, если у него есть просмотры
                if($arResult['IBLOCK_ID'] == IBLOCK_PRODUCTS){
                    $showCounter = CIBlockElement::GetProperty(IBLOCK_PRODUCTS, $id, array("sort" => "asc"), Array("CODE"=>"SHOW_COUNTER"))->Fetch();
                    if(!empty($showCounter['VALUE']) && $showCounter['VALUE'] > 0){
                        global $APPLICATION;
                        $APPLICATION->throwException("Просмотренный товар удалить нельзя.");
                        return false;
                    }
                }
            }
        }
    }

}

AddEventHandler("main", "OnBeforeUserUpdate", Array("MainHandler", "OnBeforeUserUpdateHandler"));
class MainHandler
{
    // Если пользователя добавили в группу контент-редакторы, то прислать ему на почту письма с уведомлением
    public static function OnBeforeUserUpdateHandler(&$arFields)
    {
        $isUserContentEditor = in_array(ID_CONTENT_EDITOR_GROUP, CUser::GetUserGroup($arFields['ID']));
        // Если пользователь не был контент-редактором
        if(!$isUserContentEditor){
            $userGroups = [];
            foreach ($arFields['GROUP_ID'] as $group){
                $userGroups[] = $group['GROUP_ID'];
            }
            $isUserContentEditorNow = in_array(ID_CONTENT_EDITOR_GROUP, $userGroups);
            if($isUserContentEditorNow){
                $params = ['TEXT' => $arFields['LOGIN'], 'USER_EMAIL' => $arFields['EMAIL']];
                CEvent::Send('ADD_USER_TO_CONTENT_EDITOR', 's1', $params);
            }
        }
    }
}
