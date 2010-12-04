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

class MyHookProvider_Version extends Zikula_Version
{
    public function getMetaData()
    {
        $meta = array();
        $meta['displayname'] = $this->__('MyHookProvider');
        $meta['url'] = 'myhookprovider';
        $meta['version'] = '1.0.0';
        $meta['description'] = $this->__('Module that provides hooks');
        $meta['securityschema'] = array('MyHookProvider::' => 'Modulename::');
        $meta['capabilities'] = array(HookUtil::PROVIDER_CAPABLE => array('enabled' => true));
        return $meta;
    }

    protected function setupHookBundles()
    {
         $bundle = new Zikula_Version_HookProviderBundle('modulehook_area.myhookprovider.mhp', __('MyHookProvider Hook Handlers'));
         $bundle->addHook('hookhandler.myhookprovider.ui.view', 'ui.view', 'MyHookProvider_HookHandlers', 'ui_view', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.ui.edit', 'ui.edit', 'MyHookProvider_HookHandlers', 'ui_edit', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.ui.delete', 'ui.delete', 'MyHookProvider_HookHandlers', 'ui_delete', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.validate.edit', 'validate.edit', 'MyHookProvider_HookHandlers', 'validate_edit', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.validate.delete', 'validate.delete', 'MyHookProvider_HookHandlers', 'validate_delete', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.process.edit', 'process.edit', 'MyHookProvider_HookHandlers', 'process_edit', 'myhookprovider.service', 10);
         $bundle->addHook('hookhandler.myhookprovider.process.delete', 'process.delete', 'MyHookProvider_HookHandlers', 'process_delete', 'myhookprovider.service', 10);
         $this->registerHookProviderBundle($bundle);

         $bundle = new Zikula_Version_HookProviderBundle('modulehook_area.myhookprovider.mhpfilter', __('MyHookProvider Hook Handler Filter'));
         $bundle->addHook('hookhandler.myhookprovider.ui.filter', 'ui.filter', 'MyHookProvider_HookHandlers', 'ui_filter', 'myhookprovider.service', 10);
         $this->registerHookProviderBundle($bundle);

         //... provide more area bundles if necessary
    }
}