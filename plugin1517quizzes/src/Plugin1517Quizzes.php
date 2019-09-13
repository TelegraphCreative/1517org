<?php
/**
 * Plugin 1517 Quizzes plugin for Craft CMS 3.x
 *
 * Quiz functionality for 1517.org
 *
 * @link      http://cleave.co
 * @copyright Copyright (c) 2019 John Mueller
 */

namespace telegraph\plugin1517quizzes;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use Solspace\Freeform\Services\SubmissionsService;
use Solspace\Freeform\Events\Submissions\SubmitEvent;
// use Solspace\Freeform\Services\FormsService;
// use Solspace\Freeform\Events\Forms\SaveEvent;
use Solspace\Freeform\Services\StatusesService;
use Solspace\Freeform\Events\Statuses\SaveEvent;

use barrelstrength\sproutforms\services\Entries;
use barrelstrength\sproutforms\elements\Entry;
use barrelstrength\sproutforms\events\OnBeforeSaveEntryEvent;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    John Mueller
 * @package   Plugin1517Quizzes
 * @since     1.0.0
 *
 */
class Plugin1517Quizzes extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Plugin1517Quizzes::$plugin
     *
     * @var Plugin1517Quizzes
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

	public function logIt($type, $message) {
		$message = json_encode($message);
		$datetime = date("Y-m-d H:i:s");
		$data = "\n\n$datetime  $type:  $message";
		if (($handle = fopen(dirname(__FILE__) . '/status-change-log.txt', "a")) !== FALSE) {
			fwrite($handle, $data);
			fclose($handle);
		}
    }

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * Plugin1517Quizzes::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(Entries::class, Entry::EVENT_BEFORE_SAVE, function(OnBeforeSaveEntryEvent $event) {
            if (Craft::$app->request->isSiteRequest)
            {
                // A Form Entry Element has been saved from a Front-end Form Submission
                // Access the Form Entry Element via: $event->sender
                $this->logIt('sprout', "site");
            }
            
            if (Craft::$app->request->isCpRequest)
            {
                // A Form Entry Element has been updated from the Control Panel
                // Access the Form Entry Element via: $event->sender
                $this->logIt('sprout', "cp");
            }
        });

        // Do something after we're installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    // We were just installed
                    $this->logIt('install', 'we didd it');
                }
            }
        );

        Event::on(
            SubmissionsService::class,
            SubmissionsService::EVENT_AFTER_SUBMIT,
            function (SubmitEvent $event) {
                $form = $event->getForm();
                $submission = $event->getElement();
            
                // Perform manipulations here
                $this->logIt('submission', 'entry submitted');
            }
        );

        // Event::on(
        //     FormsService::class,
        //     FormsService::EVENT_AFTER_SAVE,
        //     function (SaveEvent $event) {
        //       if ($event->isNew()) {
        //         // If the form is new
        //         // Perform some action here

        //         $this->logIt('forms', 'form saved');
        //       }
        //     }
        // );

        Event::on(
            StatusesService::class,
            StatusesService::EVENT_BEFORE_SAVE,
            function (SaveEvent $event) {
              $statusModel = $event->getModel();
              $isNew = $event->isNew();
          
              // Perform some action here
              $this->logIt('status', 'status saved');
            }
        );

/**
 * Logging in Craft involves using one of the following methods:
 *
 * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
 * Craft::info(): record a message that conveys some useful information.
 * Craft::warning(): record a warning message that indicates something unexpected has happened.
 * Craft::error(): record a fatal error that should be investigated as soon as possible.
 *
 * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
 *
 * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
 * the category to the method (prefixed with the fully qualified class name) where the constant appears.
 *
 * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
 * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
 *
 * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
 */
        Craft::info(
            Craft::t(
                'plugin-1517-quizzes',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
