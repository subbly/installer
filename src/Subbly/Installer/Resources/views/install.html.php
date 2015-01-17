<form action="" method="post">

    <h2><?php echo Subbly_Installer_I18n::l('form.generic.title') ?></h2>

    <input type="text" name="generic[shop_name]" value="<?= Subbly_Installer_View::request_input('generic.shop_name') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.generic.shop_name') ?>">

    <h2><?php echo Subbly_Installer_I18n::l('form.user.title') ?></h2>

    <input type="email" name="user[email]" value="<?= Subbly_Installer_View::request_input('user.email') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.email') ?>">
    <input type="password" name="user[password]" value="<?= Subbly_Installer_View::request_input('user.password') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.user.password') ?>">

    <h2><?php echo Subbly_Installer_I18n::l('form.db.title') ?></h2>

    <input type="text" name="db[host]" value="<?= Subbly_Installer_View::request_input('db.host') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.host') ?>">
    <input type="text" name="db[name]" value="<?= Subbly_Installer_View::request_input('db.name') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.name') ?>">
    <input type="text" name="db[username]" value="<?= Subbly_Installer_View::request_input('db.username') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.username') ?>">
    <input type="password" name="db[password]" value="<?= Subbly_Installer_View::request_input('db.password') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.password') ?>">
    <input type="text" name="db[prefix]" value="<?= Subbly_Installer_View::request_input('db.prefix') ?>" placeholder="<?php echo Subbly_Installer_I18n::l('form.db.prefix') ?>">

    <button name="submit" type="submit"><?php echo Subbly_Installer_I18n::l('form.submit') ?></button>
</form>
