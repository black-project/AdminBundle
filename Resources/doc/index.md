Getting Started With BlackAdminBundle
======================================

This bundle is a simple and old school template admin for your projects.

## Prerequisites

This bundle requires Symfony 2.3+. You also must buy the template on
[themeforest](http://themeforest.net/item/aquincum-premium-responsive-admin-template/2543882).

### Translations

If you wish to use default texts provided in this bundle, you have to make sur you have translator enabled in your
config.

``` yaml
# app/config/config.yml

framework:
    translator: ~
```

For more information about translations, check
[Symfony documentation](http://symfony.com/doc/current/book/translation.html).


## Installation

Installation is very simple and stupid.

1. Download BlackAdminBundle using composer
2. Enable your bundle
3. Buy the official theme
4. Champagne!

### Step 1: Download BlackAdminBundle

Add BlackAdminBundle in your composer.json:

```js
{
    "require": {
        "black/admin-bundle": "0.1.*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update black/admin-bundle
```

Composer will install the bundles to your project `vendor/black` directory.

### Step 2: Enable your bundles


Just load BlackAdminBundle in your AppKernel.

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Black\Bundle\CommonBundle\BlackCommonBundle(),
    );
}
```

Add the routes in your `config/routing.yml`

```yaml
admin_login:
    pattern:  /admin/login
    defaults: { _controller: BlackAdminBundle:AdminSecurity:login }

admin_login_check:
    pattern:  /admin/login_check

admin_logout:
    pattern:  /admin/logout

black_admin:
    resource: "@BlackAdminBundle/Controller/"
    type:     annotation
    prefix:   /
```

And modify your security.yml

```yaml
security:
    firewalls:
        admin:
            pattern:    ^/admin
            anonymous:  true
            context: admin
            form_login:
                login_path:  /admin/login
                check_path:  /admin/login_check
            logout:
                path:   /admin/logout
                target: /admin
            remember_me:
                key:        "%secret%"
                lifetime:   25200
                path:       /admin
                domain:     ~

    access_control:
        - { path: ^/admin/login$, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/admin/, role: [ROLE_ADMIN, IS_AUTHENTICATED_REMEMBERED] }
        - { path: ^/efconnect, role: ROLE_USER }
        - { path: ^/elfinder, role: ROLE_USER }
```

Now, we need to modify your config.yml. This is my actual configuration.

```yaml
# Assetic Configuration
assetic:
    debug:          %kernel.debug%
    use_controller: false
    bundles:        [ 'BlackAdminBundle', 'FMElfinderBundle' ]
    #java: /usr/bin/java
    filters:
        cssrewrite: ~
        less:
            node:       /opt/local/bin/node
            node_paths: [/opt/local/bin/node, /opt/local/lib/node_modules]
        #closure:
        #    jar: %kernel.root_dir%/Resources/java/compiler.jar
        yui_css:
            jar: %kernel.root_dir%/Resources/java/yuicompressor-2.4.7.jar
        yui_js:
            jar: %kernel.root_dir%/Resources/java/yuicompressor-2.4.7.jar

stfalcon_tinymce:
    tinymce_jquery: true
    language: %locale%
    selector: ".tinymce"
    theme:
        simple:
            file_browser_callback : elFinderBrowser
        advanced:
            file_browser_callback : elFinderBrowser
            plugins:
                - "advlist autolink lists link image charmap print preview hr anchor pagebreak"
                - "searchreplace wordcount visualblocks visualchars code fullscreen"
                - "insertdatetime media nonbreaking save table contextmenu directionality"
                - "template paste textcolor"
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            toolbar2: "print preview media | forecolor backcolor"
            convert_urls: false
            extended_valid_elements: "i[class],b,span[class],@[class]"
            valid_elements : '*[*]'
            verify_html: false

fm_elfinder:
    editor: tinymce4
    locale: %locale%
    connector:
        debug: false
        roots:
            uploads:
                driver: LocalFileSystem
                path: uploads
                upload_allow: ['all']
                upload_max_size: 20M
```

### Step 3: Buy the officiel theme

Just go to ThemeForest and buy [Aquincum](http://themeforest.net/item/aquincum-premium-responsive-admin-template/2543882) for $21.
Then download the archive and copy `HTML/css`, `HTML/images`, `HTML/js` to `web/admin`.


### Step 4: Champagne!

And profit!



