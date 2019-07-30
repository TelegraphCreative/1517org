<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

return [
    // Global settings
    '*' => [
        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 1,

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => true,

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => getenv('SECURITY_KEY'),

        // Whether to save the project config out to config/project.yaml
        // (see https://docs.craftcms.com/v3/project-config.html)
        'useProjectConfigFile' => true,

        // Log new user in automatically
        'autoLoginAfterAccountActivation' => true,
        'allowedFileExtensions' => '7z, aiff, asf, avi, bmp, csv, doc, docx, epub, fla, flv, gif, gz, gzip, htm, html, jp2, jpeg, jpg, jpx, js, mid, mobi, mov, mp3, mp4, m4a, m4v, mpc, mpeg, mpg, ods, odt, ogg, ogv, pdf, png, potx, pps, ppsm, ppsx, ppt, pptm, pptx, ppz, pxd, qt, ram, rar, rm, rmi, rmvb, rtf, sdc, sitd, svg, swf, sxc, sxw, tar, tgz, tif, tiff, txt, vob, vsd, wav, webm, wma, wmv, xls, xlsx, zip',

        'pageTrigger' => '?page',
    ],

    // Dev environment settings
    'dev' => [
        // Dev Mode (see https://craftcms.com/guides/what-dev-mode-does)
        'devMode' => true,
    ],

    // Staging environment settings
    'staging' => [
        // Prevent administrative changes from being made on staging
        'allowAdminChanges' => true,
    ],

    // Production environment settings
    'production' => [
        // Prevent administrative changes from being made on production
        'allowAdminChanges' => true,
    ],

];
