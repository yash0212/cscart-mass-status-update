{capture name="mainbox"}
<div id="content_group{$id}">
    <form action="{""|fn_url}" method="post" target="_self" name="update_status" class="form-horizontal">
        <input type="hidden" name="redirect_url" value="{$config.current_url}">
        <fieldset>
            <div class="control-group">
                <select id="status" name="status" class="form-control cm-required" required>
                    <option value="">{__('select_status')}</option>
                    {foreach from=$statuses_array key="code" item="status_name"}
                    <option value="{$code}">{$status_name}</option>
                    {/foreach}
                </select>
            </div>
            <div class="control-group">
                <label class="control-label" for="mail_admin">{__("mail_admin")}</label>
                <div class="controls">
                    <input id="mail_admin" type="checkbox" name="mail_admin" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="mail_vendor">{__("mail_vendor")}</label>
                <div class="controls">
                    <input id="mail_vendor" type="checkbox" name="mail_vendor" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="mail_customer">{__("mail_customer")}</label>
                <div class="controls">
                    <input id="mail_customer" type="checkbox" name="mail_customer" />
                </div>
            </div>
            {include file="pickers/orders/picker.tpl" item_ids=$orders no_item_text=__("no_items") data_id="order_ids" input_name="order_ids"}
        </fieldset>
    </form>
</div>
{/capture}

{capture name="buttons"}
{include file="buttons/button.tpl" but_role="submit-link" but_text=__('update_status') but_name="dispatch[mass_status_update.update_status]" but_target_form="update_status" }
{/capture}

{include file="common/mainbox.tpl" title=__('update_status') sidebar=$smarty.capture.sidebar content=$smarty.capture.mainbox buttons=$smarty.capture.buttons}
