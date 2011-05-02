<?php
/**
 * Copyright 2009 Zikula Foundation.
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class MyHookProvider_Installer extends Zikula_AbstractInstaller
{
    public function install()
    {
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        return true;
    }

    public function upgrade($oldversion)
    {
        HookUtil::registerProviderBundles($this->version->getHookProviderBundles());

        return true;
    }

    public function uninstall()
    {
        HookUtil::unregisterHookProviderBundles($this->version);

        return true;
    }
}
