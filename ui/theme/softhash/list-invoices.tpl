{include file="sections/header.tpl"}
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>{$paginator['found']} {$_L['Records']}. {if $paginator['found'] > 0}{$_L['Page']} {$paginator['page']} {$_L['of']} {$paginator['lastpage']}.{/if}</h5>
        <div class="ibox-tools">
            <a href="{$_url}invoices/list-recurring/" class="btn btn-info btn-xs"><i class="fa fa-repeat"></i> {$_L['Manage Recurring Invoices']}</a>
            <a href="{$_url}invoices/add/" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> {$_L['Add Invoice']}</a>

        </div>
    </div>
    <div class="ibox-content">

        <table class="table table-bordered table-hover sys_table">
            <thead>
            <tr>
                <th>#</th>
                <th>{$_L['Account']}</th>
                <th>{$_L['Amount']}</th>
                <th>{$_L['Invoice Date']}</th>
                <th>{$_L['Due Date']}</th>
                <th>{$_L['Status']}</th>
                <th>{$_L['Type']}</th>
                <th class="text-right">{$_L['Manage']}</th>
            </tr>
            </thead>
            <tbody>

            {foreach $d as $ds}
                <tr>
                    <td><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['id']}</a> </td>
                    <td><a href="{$_url}contacts/view/{$ds['userid']}/">{$ds['account']}</a> </td>
                    <td class="amount" data-a-sign="{$_c['currency_code']} "  data-a-dec="{$_c['dec_point']}" data-a-sep="{$_c['thousands_sep']}" data-d-group="2">{$ds['total']}</td>
                    <td>{date( $_c['df'], strtotime($ds['date']))}</td>
                    <td>{date( $_c['df'], strtotime($ds['duedate']))}</td>
                    <td>
                       {ib_lan_get_line($ds['status'])}

                    </td>
                    <td>
                        {if $ds['r'] eq '0'}
                            <span class="label label-success"><i class="fa fa-dot-circle-o"></i> {$_L['Onetime']}</span>
                          {else}
                            <span class="label label-success"><i class="fa fa-repeat"></i> {$_L['Recurring']}</span>
                    {/if}
                    </td>
                    <td class="text-right">
                        <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                        <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {$_L['Edit']}</a>
                        <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}"><i class="fa fa-trash"></i> {$_L['Delete']}</a>
                    </td>
                </tr>
            {/foreach}

            </tbody>
        </table>
{$paginator['contents']}
    </div>
</div>
{include file="sections/footer.tpl"}