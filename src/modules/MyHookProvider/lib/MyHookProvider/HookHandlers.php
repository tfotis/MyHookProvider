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
        // our example doesn't have any data to fetch, so we will create a random number to show :)
        $mhp_data = array('dummydata' => rand(1,9));
        $this->view->assign('mhp_data', $mhp_data);

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

        // if validation object does not exist, this is the first time display of the create/edit form.
        if (!$this->validation) {
            // either display an empty form,
            // or fill the form with existing data
            if (!$id) {
                // this is a create action so create a new empty object for editing
                $mhp_data = array('dummydata' => '');
            } else {
                // this is an edit action so we probably need to get the data from the DB for editing
                // for this example however, we don't have any data stored in db, so display something random :)
                $mhp_data = array('dummydata' => rand(1,9));
            }
        } else {
            // this is a re-entry because the form didn't validate.
            // We need to gather the input from the form and render display
            // get the input from the form (this was populated by the validation hook).
            $mhp_data = $this->validation->getObject();
        }

        // assign the hook data to the template
        $this->view->assign('mhp_data', $mhp_data);

        // and also assign the id
        $this->view->assign('id', $id);
       
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
        // our example doesn't have any data to fetch, so we will create a random number to show :)
        $mhp_data = array('dummydata' => rand(1,9));
        $this->view->assign('mhp_data', $mhp_data);
        
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
        // get data from post
        $mhp_data = FormUtil::getPassedValue('mhp_data', null, 'POST');

        // create a new hook validation object and assign it to $this->validation
        $this->validation = new Zikula_Provider_HookValidation('mhp_data', $mhp_data);

        // do the actual validation
        // for this example, the validation passes if our dummydata is a number between 1 and 9
        // otherwise the validation fais
        if (!is_numeric($mhp_data['dummydata']) || ((int)$mhp_data['dummydata'] < 1 || (int)$mhp_data['dummydata'] > 9)) {
            $this->validation->addError('dummydata', 'You must fill a number between 1 and 9.');
        }
      
        $event->data->set('hookhandler.myhookprovider.ui.edit', $this->validation);
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
        // nothing to do here really, just return
        // if however i wanted to check for something, i would do it like the
        // validate_edit function!!! [make sure you check ui_edit and process_edit also]

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
        // check for validation here
        if (!$this->validation) {
            return;
        }
        
        // and perform necessary action depending on insert or update
        // this example does not store any data, but if it would,
        // then we could do something like this
        $mhp_data = $this->validation->getObject();

        if (!$event['id']) {
            // new so do an INSERT
        } else {
            // existing so do an UPDATE
        }
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
        // this example does not have an data stored in database to delete
        // however, if i had any, i would execute a db call here to delete them
    }
}
