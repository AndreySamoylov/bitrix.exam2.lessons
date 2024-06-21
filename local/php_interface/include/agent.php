<?

function AgentCheckStock()
{
    if(CModule::IncludeModule("iblock")) {
        $arSelect = array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_LINK");
        $arFilter = array("IBLOCK_ID" => IBLOCK_STOCK, "<DATE_ACTIVE_TO" => ConvertTimeStamp(time(),"FULL"));
        $rsResCat = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
        $arItems = array();
        while($arItemCat = $rsResCat->GetNext())
        {
            $arItems[] = $arItemCat;
        }

        CEventLog::Add(array(
                "SEVERITY" => "SECURITY",
				"AUDIT_TYPE_ID" => "CHECK_STOCK",
				"MODULE_ID" => "iblock",
				"ITEM_ID" => "",
				"DESCRIPTION" => "Акции с наступивщей датой окончания (Я АГЕНТ) = ".count($arItems),
        ));

        if(count($arItems) > 0)
        {
            $arFilter = Array(
                "GROUPS_ID" => Array(ID_ADMINISTRATION_GROUP)
            );
            $rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter);
            $arEmail = array();
            while($arResUser = $rsUsers->GetNext())
            {
                $arEmail[] = $arResUser["EMAIL"];

            }

            if(count($arEmail) > 0)
            {
                $arEventFields = array(
                    "TEXT" => "Акции с наступивщей датой окончания = ".count($arItems),
                    "EMAIL" => implode(", ", $arEmail),
                );
                CEvent::Send("CHECK_STOCK", "s1", $arEventFields);
            }
        }
    }
    return 'AgentCheckStock();';
}
