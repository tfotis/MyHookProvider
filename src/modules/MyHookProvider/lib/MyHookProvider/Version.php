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

class MyHookProvider_Version extends Zikula_AbstractVersion
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
         $bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.myhookprovider.ui_hooks.mhp', 'ui_hooks', __('MyHookProvider Hook Handlers'));
         $bundle->addServiceHandler('display_view', 'MyHookProvider_HookHandler_Mhp', 'ui_view', 'myhookprovider.mhp');
         $bundle->addServiceHandler('form_edit', 'MyHookProvider_HookHandler_Mhp', 'ui_edit', 'myhookprovider.mhp');
         $bundle->addServiceHandler('form_delete', 'MyHookProvider_HookHandler_Mhp', 'ui_delete', 'myhookprovider.mhp');
         $bundle->addServiceHandler('validate_edit', 'MyHookProvider_HookHandler_Mhp', 'validate_edit', 'myhookprovider.mhp');
         $bundle->addServiceHandler('validate_delete', 'MyHookProvider_HookHandler_Mhp', 'validate_delete', 'myhookprovider.mhp');
         $bundle->addServiceHandler('process_edit', 'MyHookProvider_HookHandler_Mhp', 'process_edit', 'myhookprovider.mhp');
         $bundle->addServiceHandler('process_delete','MyHookProvider_HookHandler_Mhp', 'process_delete', 'myhookprovider.mhp');
         $this->registerHookProviderBundle($bundle);

         $bundle = new Zikula_HookManager_ProviderBundle($this->name, 'provider.myhookprovider.filter_hooks.mhpfilter', 'filter_hooks', __('MyHookProvider Hook Handler Filter'));
         $bundle->addStaticHandler('filter', 'MyHookProvider_HookHandler_Mhp', 'ui_filter', true);
         $this->registerHookProviderBundle($bundle);

         //... provide more area bundles if necessary
    }
}