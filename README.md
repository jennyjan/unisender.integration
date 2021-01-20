# unisender.integration
Модуль для интеграции с Api Unisender

## WhereToUse
###### local/components/shop/sale.order.ajax/class.php

##### Добавить функцию unisenderSubscribe() - добавление пользователя в список рассылки Unisender

    <?php
    protected function unisenderSubscribe()
    {
        $personType = $this->request->get('PERSON_TYPE');
        $userSubscribe = $this->request->get('USER_SUBSCRIBE');
        $userProps = Sale\PropertyValue::getMeaningfulValues($personType, $this->getPropertyValuesFromRequest());

        if($userSubscribe == 'Y') {
            try {
                if(CModule::IncludeModule('unisender.integration')) {
                    $apiKey = 'apiKey';
                    $listId = '123456789';
                    $unisenderApi = new Unisender\Integration\UnisenderApi($apiKey);

                    $userEmail = (is_array($userProps) && strlen($userProps['EMAIL']) > 0) ? $userProps['EMAIL'] : '';
                    $payerName = (is_array($userProps) && strlen($userProps['PAYER']) > 0) ? $userProps['PAYER'] : '';

                    $fields['Name'] = $payerName;
                    $fields['email'] = $userEmail;
                    $result = $unisenderApi->subscribe(Array("list_ids" => $listId, 
                        "fields" => $fields, 
                        "double_optin" => 3)
                    );
                }
            } catch(Exception $e) {
                return false;
            }
        }
    }
	?>

##### Вызвать в saveOrderAjaxAction() после условия:
	<?
        if ($isActiveUser && empty($this->arResult['ERROR'])) {
            $this->unisenderSubscribe();
        }
	?>
