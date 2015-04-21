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
                                    <span id="generic_option_english" class="field-option"><?php echo Subbly_Installer_I18n::l('form.generic.languages.english') ?></span>
                                    <span id="generic_option_french" class="field-option"><?php echo Subbly_Installer_I18n::l('form.generic.languages.french') ?></span>
                                </div>
                                <input id="generic_language" type="hidden" name="generic[language]" value="english" />
                            </div>
                            <div class="fields-group">
                                <label for="generic_shop_name"><?php echo Subbly_Installer_I18n::l('form.generic.shop_name.label') ?></label>
                                <input id="generic_shop_name" type="text" name="generic[shop_name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.generic.shop_name.placeholder') ?>" />
                            </div>
                            <div class="fields-group">
                                <a class="button button-rounded" href="#form-user"><?php echo Subbly_Installer_I18n::l('form.generic.links.next') ?></a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-user" class="full">
                    <div class="vertical-center-wrapper">
                        <div class="container">
                            <?php /* <h2><?php echo Subbly_Installer_I18n::l('form.user.title') ?></h2> */ ?>
                            <div class="fields-group">
                                <input type="email" name="user[email]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.email') ?>" />
                            </div>
                            <div class="fields-group">
                                <input type="password" name="user[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.password') ?>" />
                            </div>
                            <div class="fields-group">
                                <label for="generic_admin_baseurl"><?php echo Subbly_Installer_I18n::l('form.generic.admin.base_url.label') ?></label>
                                <input type="text" name="generic[admin_baseurl]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.generic.admin.base_url') ?>" />
                            </div>
                            <div class="fields-group">
                                <a class="button button-rounded" href="#form-db"><?php echo Subbly_Installer_I18n::l('form.user.links.next') ?></a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-db" class="full">
                    <div class="vertical-center-wrapper">
                        <div class="container">
                            <?php /* <h2><?php echo Subbly_Installer_I18n::l('form.db.title') ?></h2> */ ?>
                            <div class="fields-group">
                                <input type="text" name="db[host]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.host') ?>" />
                            </div>
                            <div class="fields-group">
                                <input type="text" name="db[name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.name') ?>" />
                            </div>
                            <div class="fields-group">
                                <input type="text" name="db[username]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.username') ?>" />
                            </div>
                            <div class="fields-group">
                                <input type="password" name="db[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.password') ?>" />
                            </div>
                            <div class="fields-group">
                                <input type="text" name="db[prefix]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.prefix') ?>" />
                            </div>
                            <input class="button button-rounded" type="submit" name="submit" value="<?php echo Subbly_Installer_I18n::l('form.submit') ?>" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </main>
    </div>
</section>
<script><?php echo Subbly_Installer_ViewContainer::partial('assets/js/app.min.js'); ?></script>

