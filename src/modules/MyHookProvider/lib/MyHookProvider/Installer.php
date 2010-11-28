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

class MyHookProvider_Installer extends Zikula_Installer
{
    public function install()
    {
        HookUtil::registerHookProviderBundles($this->version);

        return true;
    }

    public function upgrade($oldversion)
    {
        HookUtil::registerHookProviderBundles($this->version);

        return true;
    }

    public function uninstall()
    {
        HookUtil::unRegisterHookProviderBundles($this->version);
        
        return true;
    }
}
