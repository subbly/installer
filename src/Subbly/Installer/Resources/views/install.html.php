<form action="" method="post">

    <h2><?= Subbly_Installer_I18n::l('form.generic.title') ?></h2>

    <input type="text" name="generic[shop_name]" value="">

    <h2><?= Subbly_Installer_I18n::l('form.user.title') ?></h2>

    <input type="email" name="user[email]" value="">
    <input type="text" name="user[username]" value="">
    <input type="password" name="user[password]" value="">

    <h2><?= Subbly_Installer_I18n::l('form.mysql.title') ?></h2>

    <input type="text" name="db[host]" value="">
    <input type="text" name="db[name]" value="">
    <input type="text" name="db[username]" value="">
    <input type="password" name="db[password]" value="">
    <input type="text" name="db[prefix]" value="">

    <button name="submit"><?= Subbly_Installer_I18n::l('form.submit') ?></button>
</form>
