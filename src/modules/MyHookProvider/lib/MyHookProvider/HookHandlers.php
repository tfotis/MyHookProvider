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

class MyHookProvider_HookHandlers extends Zikula_HookHandler
{
    /**
     * Zikula_View instance
     * @var object
     */
    private $view;

    /**
     * Post constructor hook.
     *
     * @return void
     */
    public function setup()
    {
        $this->view = Zikula_View::getInstance("MyHookProvider");
    }

    /**
     * Display hook for view.
     *
     * Subject is the object being viewed that we're attaching to.
     * args[id] is the id of the object.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function ui_view(Zikula_Event $event)
    {
        // Security check
        if (!SecurityUtil::checkPermission('MyHookProvider::', '::', ACCESS_READ)) {
            return;
        }

        // do some stuff here like get data from database to show in template
        //

        // add this response to the event stack
        $area = 'modulehook_area.myhookprovider.mhp';
        $event->data[$area] = new Zikula_Response_DisplayHook($area, $this->view, 'myhookprovider_hook_mhp_ui_view.tpl');
    }

     /**
     * Display hook for edit views.
     *
     * Subject is the object being created/edited that we're attaching to.
     * args[id] Is the ID of the subject.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function ui_edit(Zikula_Event $event)
    {
        // get data from $event
        $id = $event['id'];

        if (!$id) {
            $access_type = ACCESS_EDIT;
        } else {
            $access_type = ACCESS_ADD;
        }

        // Security check
        if (!SecurityUtil::checkPermission('MyHookProvider::', '::', $access_type)) {
            return;
        }

        // assign id to template
        $this->view->assign('id', $id);

        // show some data here or plain form or form with highlighted fields here if it didn't pass validation
        //

        // add this response to the event stack
        $area = 'modulehook_area.myhookprovider.mhp';
        $event->data[$area] = new Zikula_Response_DisplayHook($area, $this->view, 'myhookprovider_hook_mhp_ui_edit.tpl');
    }

    /**
     * Display hook for delete views.
     *
     * Subject is the object being created/edited that we're attaching to.
     * args[id] Is the ID of the subject.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function ui_delete(Zikula_Event $event)
    {
        // Security check
        if (!SecurityUtil::checkPermission('MyHookProvider::', '::', ACCESS_DELETE)) {
            return;
        }

        // do some stuff here like get data from database to show in template
        //

        // add this response to the event stack
        $area = 'modulehook_area.myhookprovider.mhp';
        $event->data[$area] = new Zikula_Response_DisplayHook($area, $this->view, 'myhookprovider_hook_mhp_ui_delete.tpl');
    }

    /**
     * Filter hook for view
     *
     * Subject is the object being viewed that we're attaching to.
     * args[id] is the id of the object.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function ui_filter(Zikula_Event $event)
    {
        $data = $event->getData();
        $data .= "<br />" . $this->__('This data has been transformed by adding this text.');
        $event->setData($data);
    }

    /**
     * validation handler for validate.edit hook type.
     *
     * The property $event->data is an instance of Zikula_Collection_HookValidationProviders
     * Use the $event->data->set() method to log the validation response.
     *
     * This method populates this hookhandler object with a Zikula_Provider_HookValidation
     * so the information is available to the ui_edit method if validation fails,
     * and so the process_* can write the validated data to the database.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function validate_edit(Zikula_Event $event)
    {
        LogUtil::registerStatus($this->__('validate_edit method completed.'));
        return;
    }

    /**
     * validation handler for validate.delete hook type.
     *
     * The property $event->data is an instance of Zikula_Collection_HookValidationProviders
     * Use the $event->data->set() method to log the validation response.
     *
     * This method populates this hookhandler object with a Zikula_Provider_HookValidation
     * so the information is available to the ui_edit method if validation fails,
     * and so the process_* can write the validated data to the database.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function validate_delete(Zikula_Event $event)
    {
        LogUtil::registerStatus($this->__('validate_delete method completed.'));
        return;
    }

    /**
     * process edit hook handler.
     *
     * This should be executed only if the validation has succeeded.
     * This is used for both new and edit actions.  We can determine which
     * by the presence of an ID field or not.
     *
     * Subject is the object being created/edited that we're attaching to.
     * args[id] Is the ID of the subject.
     * args[caller] the module who notified of this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function process_edit(Zikula_Event $event)
    {
        LogUtil::registerStatus($this->__('process_edit method completed.'));
        // check for validation (if we have any)
        // and then do insert or update depending on action
    }

    /**
     * delete process hook handler.
     *
     * The subject should be the object that was deleted.
     * args[id] Is the is of the object
     * args[caller] is the name of who notified this event.
     *
     * @param Zikula_Event $event
     *
     * @return void
     */
    public function process_delete(Zikula_Event $event)
    {
        LogUtil::registerStatus($this->__('process_delete method completed.'));
        // check for validation (if we have any)
        // and then do deletion
    }
}
