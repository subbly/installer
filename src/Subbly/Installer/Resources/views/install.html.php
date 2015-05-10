<section class="container-fluid">
    <div class="row">
        <aside id="app-aside" class="col-sm-3">
            <h1 id="app-title">Subbly</h1>
        </aside>
        <main id="app-content" class="col-sm-push-3 col-sm-9">
            <form class="subbly-form" action="" method="post">
                <fieldset id="form-generic" class="full">
                    <div class="vertical-center-wrapper">
                        <h2 class="form-subtitle">{{{ languages[locale]['form.generic.title'] }}}</h2>
                        <div class="fields-group">
                            <label>{{{ languages[locale]['form.generic.languages.label'] }}}</label>
                            <div class="field-options">
                                <a id="generic_option_english" class="field-option language-option active" v-on='click: onLanguageSelectorClick' v-class='active: locale == "english"' data-locale="english" href="#english">{{{ languages[locale]['form.generic.languages.english'] }}}</a>
                                <a id="generic_option_french" class="field-option language-option" v-on='click: onLanguageSelectorClick' v-class='active: locale == "french"' data-locale="french" href="#french">{{{ languages[locale]['form.generic.languages.french'] }}}</a>
                            </div>
                            <input id="generic_language" type="hidden" name="generic[language]" v-model='locale' />
                        </div>
                        <div class="fields-group">
                            <label for="generic_shop_name">{{{ languages[locale]['form.generic.shop_name.label'] }}}</label>
                            <input id="generic_shop_name" type="text" name="generic[shop_name]" value="" placeholder="{{{ languages[locale]['form.generic.shop_name.placeholder'] }}}" />
                        </div>
                        <div class="fields-group">
                            <a class="button button-rounded button-step" href="#form-user" data-scroll>{{{ languages[locale]['form.generic.links.next'] }}}</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-user" class="full">
                    <div class="vertical-center-wrapper">
                        <?php /* <h2>{{{ languages[locale]['form.user.title'] }}}</h2> */ ?>
                        <div class="fields-group">
                            <label for="user_email">{{{ languages[locale]['form.user.email.label'] }}}</label>
                            <input id="user_email" type="email" name="user[email]" value="" placeholder="{{{ languages[locale]['form.user.email.placeholder'] }}}" />
                        </div>
                        <div class="fields-group">
                            <label for="user_password">{{{ languages[locale]['form.user.password.label'] }}}</label>
                            <input id="user_password" type="password" name="user[password]" value="" placeholder="{{{ languages[locale]['form.user.password.placeholder'] }}}" />
                        </div>
                        <div class="fields-group">
                            <label for="user_admin_base_url">{{{ languages[locale]['form.user.admin.base_url.label'] }}}</label>
                            <input id="user_admin_base_url" type="text" name="generic[admin_baseurl]" value="" placeholder="{{{ languages[locale]['form.user.admin.base_url.placeholder'] }}}" />
                        </div>
                        <div class="fields-group">
                            <a class="button button-rounded button-step" href="#form-db" data-scroll>{{{ languages[locale]['form.user.links.next'] }}}</a>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="form-db" class="full">
                    <div class="vertical-center-wrapper">
                        <?php /* <h2>{{{ languages[locale]['form.db.title'] }}}</h2> */ ?>
                        <div class="fields-row">
                            <div class="fields-col fields-group">
                                <label for="db_host">{{{ languages[locale]['form.db.host.label'] }}}</label>
                                <input id="db_host" type="text" name="db[host]" value="" placeholder="{{{ languages[locale]['form.db.host.placeholder'] }}}" />
                            </div>
                            <div class="fields-col fields-group">
                                <label for="db_name">{{{ languages[locale]['form.db.name.label'] }}}</label>
                                <input id="db_name" type="text" name="db[name]" value="" placeholder="{{{ languages[locale]['form.db.name.placeholder'] }}}" />
                            </div>
                        </div>
                        <div class="fields-row">
                            <div class="fields-col fields-group">
                                <label for="db_username">{{{ languages[locale]['form.db.username.label'] }}}</label>
                                <input id="db_username" type="text" name="db[username]" value="" placeholder="{{{ languages[locale]['form.db.username.placeholder'] }}}" />
                            </div>
                            <div class="fields-col fields-group">
                                <label for="db_password">{{{ languages[locale]['form.db.password.label'] }}}</label>
                                <input id="db_password" type="password" name="db[password]" value="" placeholder="{{{ languages[locale]['form.db.password.placeholder'] }}}" />
                            </div>
                        </div>
                        <div class="fields-group">
                            <label for="db_prefix">{{{ languages[locale]['form.db.prefix.label'] }}}</label>
                            <input id="db_prefix" type="text" name="db[prefix]" value="" placeholder="{{{ languages[locale]['form.db.prefix.placeholder'] }}}" />
                        </div>
                        <input class="button button-rounded" type="submit" name="submit" value="{{{ languages[locale]['form.submit'] }}}" />
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
