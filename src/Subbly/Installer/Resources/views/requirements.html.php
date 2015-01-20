
<h2><?php echo Subbly_Installer_I18n::l('requirements.title') ?></h2>

<p><?php echo Subbly_Installer_I18n::l('requirements.text') ?></p>


<ul>
    <?php foreach ($requirements->getInstalledModules() as $groupModules => $modules): ?>
        <li><?php print_r($modules) ?></li>
    <?php endforeach; ?>
</ul>

<ul>
    <?php foreach ($requirements->getMissingModules() as $groupModules => $modules): ?>
    <li><?php print_r($modules) ?></li>
    <?php endforeach; ?>
</ul>
