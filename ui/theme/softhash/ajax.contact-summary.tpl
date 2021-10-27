
<p>

    <strong>{$_L['Full Name']}: </strong> {$d['account']} <br>
   {if ($d['company']) neq ''}
       <strong>{$_L['Company Name']}: </strong> {$d['company']} <br>
   {/if}
    <strong>{$_L['Email']}: </strong> {if ($d['email']) neq ''} {$d['email']} {else} N/A {/if} <br>
    <strong>{$_L['Phone']}: </strong> {if ($d['phone']) neq ''} {$d['phone']} {else} N/A {/if} <br>
    <strong>{$_L['Address']}: </strong> {if ($d['address']) neq ''} {$d['address']} {else} N/A {/if} <br>
    <strong>{$_L['City']}: </strong> {if ($d['city']) neq ''} {$d['city']} {else} N/A {/if} <br>
    <strong>{$_L['State Region']}: </strong> {if ($d['state']) neq ''} {$d['state']} {else} N/A {/if} <br>
    <strong>{$_L['ZIP Postal Code']}: </strong> {if ($d['zip']) neq ''} {$d['zip']} {else} N/A {/if} <br>
    <strong>{$_L['Country']}: </strong> {if ($d['country']) neq ''} {$d['country']} {else} N/A {/if} <br>
    <strong>{$_L['Tags']}: </strong> {if ($d['tags']) neq ''} {$d['tags']} {else} N/A {/if} <br>

    {foreach $cf as $c}

        <strong>{$c['fieldname']}: </strong> {if get_custom_field_value($c['id'],$d['id']) neq ''} {get_custom_field_value($c['id'],$d['id'])} {else} N/A {/if} <br>

    {/foreach}

</p>

<hr>


<table class="table table-hover margin bottom">
    <thead>
    <tr>

        <th colspan="3">{$_L['Accounting Summary']}</th>

    </tr>
    </thead>
    <tbody>
    <tr>

        <td> {$_L['Total Income']}
        </td>
        <td class="text-center"><span class="label label-primary">{$_c['currency_code']} {number_format($ti,2,$_c['dec_point'],$_c['thousands_sep'])}</span></td>
        {*<td class="text-center"><button class="btn btn-outline btn-primary btn-xs" type="button"><i class="fa fa-plus"></i></button></td>*}

    </tr>
    <tr>

        <td> {$_L['Total Expense']}
        </td>
        <td class="text-center"><span class="label label-danger">{$_c['currency_code']} {number_format($te,2,$_c['dec_point'],$_c['thousands_sep'])}</span></td>
        {*<td class="text-center"><button class="btn btn-outline btn-danger btn-xs" type="button"><i class="fa fa-minus"></i></button></td>*}

    </tr>

    </tbody>
</table>