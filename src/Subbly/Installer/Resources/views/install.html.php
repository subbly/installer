<section class="container-fluid">
    <div class="row">
        <aside id="app-aside" class="col-md-3">
            <h1 id="app-title" class="text-right">Subbly</h1>
        </aside>
        <main id="app-content" class="col-md-push-3 col-md-9">
            <form class="subbly-form" action="" method="post">
                <fieldset id="form-generic" class="full">
                    <div class="vertical-center-wrapper">
                        <div class="container">
                            <h2 class="form-subtitle"><?php echo Subbly_Installer_I18n::l('form.generic.title') ?></h2>
                            <div class="fields-group">
                                <label><?php echo Subbly_Installer_I18n::l('form.generic.languages.label') ?></label>
                                <div class="field-options">
                                    <a id="generic_option_english" class="field-option language-option active" data-value="english" href="#english"><?php echo Subbly_Installer_I18n::l('form.generic.languages.english') ?></a>
                                    <a id="generic_option_french" class="field-option language-option" data-value="french" href="#french"><?php echo Subbly_Installer_I18n::l('form.generic.languages.french') ?></a>
                                </div>
                                <input id="generic_language" type="hidden" name="generic[language]" value="english" />
                            </div>
                            <div class="fields-group">
                                <label for="generic_shop_name"><?php echo Subbly_Installer_I18n::l('form.generic.shop_name.label') ?></label>
                                <input id="generic_shop_name" type="text" name="generic[shop_name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.generic.shop_name.placeholder') ?>" />
                            </div>
                            <div class="fields-group">
                                <a class="button button-rounded" href="#form-user" data-scroll><?php echo Subbly_Installer_I18n::l('form.generic.links.next') ?></a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-user" class="full">
                    <div class="vertical-center-wrapper">
                        <div class="container">
                            <?php /* <h2><?php echo Subbly_Installer_I18n::l('form.user.title') ?></h2> */ ?>
                            <div class="fields-group">
                                <label for="user_email"><?php echo Subbly_Installer_I18n::l('form.user.email.label') ?></label>
                                <input id="user_email" type="email" name="user[email]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.email.placeholder') ?>" />
                            </div>
                            <div class="fields-group">
                                <label for="user_password"><?php echo Subbly_Installer_I18n::l('form.user.password.label') ?></label>
                                <input id="user_password" type="password" name="user[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.password.placeholder') ?>" />
                            </div>
                            <div class="fields-group">
                                <label for="user_admin_base_url"><?php echo Subbly_Installer_I18n::l('form.user.admin.base_url.label') ?></label>
                                <input id="user_admin_base_url" type="text" name="generic[admin_baseurl]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.admin.base_url.placeholder') ?>" />
                            </div>
                            <div class="fields-group">
                                <a class="button button-rounded" href="#form-db" data-scroll><?php echo Subbly_Installer_I18n::l('form.user.links.next') ?></a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-db" class="full">
                    <div class="vertical-center-wrapper">
                        <div class="container">
                            <?php /* <h2><?php echo Subbly_Installer_I18n::l('form.db.title') ?></h2> */ ?>
                            <div class="fields-row">
                                <div class="fields-col fields-group">
                                    <label for="db_host"><?php echo Subbly_Installer_I18n::l('form.db.host.label') ?></label>
                                    <input id="db_host" type="text" name="db[host]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.host.placeholder') ?>" />
                                </div>
                                <div class="fields-col fields-group">
                                    <label for="db_name"><?php echo Subbly_Installer_I18n::l('form.db.name.label') ?></label>
                                    <input id="db_name" type="text" name="db[name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.name.placeholder') ?>" />
                                </div>
                            </div>
                            <div class="fields-row">
                                <div class="fields-col fields-group">
                                    <label for="db_username"><?php echo Subbly_Installer_I18n::l('form.db.username.label') ?></label>
                                    <input id="db_username" type="text" name="db[username]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.username.placeholder') ?>" />
                                </div>
                                <div class="fields-col fields-group">
                                    <label for="db_password"><?php echo Subbly_Installer_I18n::l('form.db.password.label') ?></label>
                                    <input id="db_password" type="password" name="db[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.password.placeholder') ?>" />
                                </div>
                            </div>
                            <div class="fields-group">
                                <label for="db_prefix"><?php echo Subbly_Installer_I18n::l('form.db.prefix.label') ?></label>
                                <input id="db_prefix" type="text" name="db[prefix]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.prefix.placeholder') ?>" />
                            </div>
                            <input class="button button-rounded" type="submit" name="submit" value="<?php echo Subbly_Installer_I18n::l('form.submit') ?>" />
                        </div>
                    </div>
                </fieldset>
            </form>
            <ul class="steps right">
                <li class="step"><a class="active" href="#form-generic" data-scroll></a></li>
                <li class="step"><a href="#form-user" data-scroll></a></li>
                <li class="step"><a href="#form-db" data-scroll></a></li>
            </ul>
        </main>
    </div>
</section>
<script><?php echo Subbly_Installer_ViewContainer::partial('assets/js/app.js'); ?></script>

