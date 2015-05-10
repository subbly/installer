<html>
<head>
    <title></title>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width' />
    <style><?php echo Subbly_Installer_ViewContainer::partial('assets/css/app.min.css'); ?></style>
</head>
<body>
    <?php echo Subbly_Installer_ViewContainer::partial($_page_template, $_view_params); ?>
    <script>
        var translations = <?php echo json_encode($_locales_values); ?>;
        <?php echo Subbly_Installer_ViewContainer::partial('assets/js/app.js'); ?>
    </script>
</body>
</html>
