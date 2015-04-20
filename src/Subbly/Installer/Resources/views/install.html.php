<form action="" method="post">

    <h2><?php echo Subbly_Installer_I18n::l('form.generic.title') ?></h2>

    <input type="text" name="generic[shop_name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.generic.shop_name') ?>">
    <input type="text" name="generic[admin_baseurl]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.admin.base_url') ?>">

    <h2><?php echo Subbly_Installer_I18n::l('form.user.title') ?></h2>

    <input type="email" name="user[email]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.email') ?>">
    <input type="password" name="user[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.password') ?>">

    <h2><?php echo Subbly_Installer_I18n::l('form.db.title') ?></h2>

    <input type="text" name="db[host]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.host') ?>">
    <input type="text" name="db[name]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.name') ?>">
    <input type="text" name="db[username]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.username') ?>">
    <input type="password" name="db[password]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.password') ?>">
    <input type="text" name="db[prefix]" value="" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.prefix') ?>">

    <button name="submit" type="submit"><?php echo Subbly_Installer_I18n::l('form.submit') ?></button>
</form>
