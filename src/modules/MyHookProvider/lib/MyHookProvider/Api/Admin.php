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

class MyHookProvider_Api_Admin extends Zikula_AbstractApi
{
    // get available admin panel links
    public function getlinks($args)
    {
        $links = array();

        $links[] = array('url' => ModUtil::url('MyHookProvider', 'admin', 'modifyconfig'), 'text' => $this->__('Settings'), 'class' => 'z-icon-es-config');

        // return output
        return $links;
    }
}