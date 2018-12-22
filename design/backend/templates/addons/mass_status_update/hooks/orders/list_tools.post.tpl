{if $orders && !$runtime.company_id}
    <li class="divider"></li>
    <li>{btn type="list" text=__('mass_status_update') dispatch="dispatch[mass_status_update.update]" form="orders_list_form"}</li>
{/if}
