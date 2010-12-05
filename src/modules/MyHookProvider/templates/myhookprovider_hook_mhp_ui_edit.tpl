<fieldset>
<legend>MyHookProvider Data</legend>

<div>This template is shown for handler 'hookhandler.myhookprovider.ui.edit' and area 'mhp'.</div>

<div>
{if $id}
This is an <strong>edit</strong> operation
{else}
This is a <strong>new</strong> operation
{/if}
</div>

<div class="z-formrow">
    <label for="mhp_data_dummy">Enter a number from 1 to 9. This will be validated with use of the hook handler</label>
    <input type="textbox" id="mhp_data_dummydata" name="mhp_data[dummydata]" value="{$mhp_data.dummydata|safetext}" />
</div>

</fieldset>

