<?php
/**
 * Webstraxt - https://www.webstraxt.com/
 * Copyright © Webstraxt Limited 2021-present. All rights reserved.
 * This product is licensed
 * See https://www.webstraxt.com/license
 */

namespace Webstraxt\EnvoyerHeartbeat\Cron;

class Heartbeat{

    private $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        $enable = $this->scopeConfig->getValue('envoyer/envoyer/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $url = $this->scopeConfig->getValue('envoyer/envoyer/url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if($enable == 1 && !empty($url)){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}