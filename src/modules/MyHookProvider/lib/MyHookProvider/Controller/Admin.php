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

class MyHookProvider_Controller_Admin extends Zikula_Controller
{
    public function postInitialize()
    {
        $this->view->setCaching(false);
    }

    // main function
    public function main()
    {
        return $this->modifyconfig();
    }

    public function modifyconfig()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'MyHookProvider::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        return $this->view->fetch('myhookprovider_admin_main.tpl');
    }
}
