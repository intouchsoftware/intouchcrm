{include file="sections/header.tpl"}
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">

    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{$_L['Add Contact']}</h5>

            </div>
            <div class="ibox-content" id="ibox_form">
                <div class="alert alert-danger" id="emsg">
                    <span id="emsgbody"></span>
                </div>

                <form class="form-horizontal" id="rform">

                    <div class="form-group"><label class="col-lg-2 control-label" for="account">{$_L['Full Name']}</label>

                        <div class="col-lg-10"><input type="text" id="account" name="account" class="form-control">

                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label" for="company">{$_L['Company Name']}</label>

                        <div class="col-lg-10"><input type="text" id="company" name="company" class="form-control">

                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label" for="email">{$_L['Email']}</label>

                        <div class="col-lg-10"><input type="text" id="email" name="email" class="form-control">

                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label" for="phone">{$_L['Phone']}</label>

                        <div class="col-lg-10"><input type="text" id="phone" name="phone" class="form-control">

                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label" for="address">{$_L['Address']}</label>

                        <div class="col-lg-10"><input type="text" id="address" name="address" class="form-control">

                        </div>
                    </div>


                    <div class="form-group"><label class="col-lg-2 control-label" for="city">{$_L['City']}</label>

                        <div class="col-lg-10"><input type="text" id="city" name="city" class="form-control">

                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label" for="state">{$_L['State Region']}</label>

                        <div class="col-lg-10"><input type="text" id="state" name="state" class="form-control">

                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label" for="zip">{$_L['ZIP Postal Code']} </label>

                        <div class="col-lg-10"><input type="text" id="zip" name="zip" class="form-control">

                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-2 control-label" for="country">{$_L['Country']}</label>

                        <div class="col-lg-10">

                            <select name="country" id="country" class="form-control">
                                <option value="">{$_L['Select Country']}</option>
                               {$countries}
                            </select>

                        </div>
                    </div>

                    {*run foreach*}

                    {foreach $fs as $f}
                        <div class="form-group"><label class="col-lg-2 control-label" for="cf{$f['id']}">{$f['fieldname']}</label>
                        {if ($f['fieldtype']) eq 'text'}


                                <div class="col-lg-10">
                                    <input type="text" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                    {if ($f['description']) neq ''}
                                        <span class="help-block">{$f['description']}</span>
                                    {/if}

                                </div>

                        {elseif ($f['fieldtype']) eq 'password'}

                            <div class="col-lg-10">
                                <input type="password" id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>

                        {elseif ($f['fieldtype']) eq 'dropdown'}
                            <div class="col-lg-10">
                                <select id="cf{$f['id']}" name="cf{$f['id']}" class="form-control">
                                    {foreach explode(',',$f['fieldoptions']) as $fo}
                                        <option value="{$fo}">{$fo}</option>
                                    {/foreach}
                                </select>
                                {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>


                        {elseif ($f['fieldtype']) eq 'textarea'}

                            <div class="col-lg-10">
                                <textarea id="cf{$f['id']}" name="cf{$f['id']}" class="form-control" rows="3"></textarea>
                                {if ($f['description']) neq ''}
                                    <span class="help-block">{$f['description']}</span>
                                {/if}
                            </div>

                        {else}
                        {/if}
                        </div>
                    {/foreach}

                    <div class="form-group"><label class="col-lg-2 control-label" for="tags">{$_L['Tags']}</label>

                        <div class="col-lg-10">
                            {*<input type="text" id="tags" name="tags" style="width:100%">*}
                            <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                {foreach $tags as $tag}
                                    <option value="{$tag['text']}">{$tag['text']}</option>
                                {/foreach}

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit" id="submit"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
{include file="sections/footer.tpl"}