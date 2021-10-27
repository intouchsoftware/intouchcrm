<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>
        <th>#</th>
        <th>{$_L['Account']}</th>
        <th>{$_L['Amount']}</th>
        <th>{$_L['Invoice Date']}</th>
        <th>{$_L['Due Date']}</th>
        <th>{$_L['Status']}</th>
        <th class="text-right">{$_L['Manage']}</th>
    </tr>
    </thead>
    <tbody>

    {foreach $i as $is}
        <tr>
            <td>{$is['id']}</td>
            <td>{$is['account']}</td>
            <td>{$_c['currency_code']} {number_format($is['total'],2,$_c['dec_point'],$_c['thousands_sep'])}</td>
            <td>{date( $_c['df'], strtotime($is['date']))}</td>
            <td>{date( $_c['df'], strtotime($is['duedate']))}</td>
            <td>{ib_lan_get_line($is['status'])}</td>
            <td>
                <a href="{$_url}invoices/view/{$is['id']}/" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> {$_L['View']}</a>
                <a href="{$_url}invoices/edit/{$is['id']}/" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {$_L['Edit']}</a>
            </td>
        </tr>
    {/foreach}

    </tbody>
</table>