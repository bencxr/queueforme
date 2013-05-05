<?php
class MerchantShortNameRoute extends CakeRoute {
 
    function parse($url) {
        $params = parent::parse($url);
        if (empty($params)) {
            return false;
        }
        App::import('Model', 'Merchant');
        $Merchant = new Merchant();
        $count = $Merchant->find('count', array(
            'conditions' => array('Merchant.shortname' => $params['shortname']),
            'recursive' => -1
        ));
        if ($count) {
            return $params;
        }

        return false;
    }
}
