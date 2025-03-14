<?php

namespace BKCmedia\TwillCookieConsent;

use BKCmedia\TwillCookieConsent\Composers\ConsentComposer;
use BKCmedia\TwillCookieConsent\Composers\ScriptComposer;
use BKCmedia\TwillCookieConsent\Helpers\CookieHelper;
use Illuminate\Support\Facades\View;
use A17\Twill\TwillPackageServiceProvider;

class TwillCookieConsentServiceProvider extends TwillPackageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Config
        $this->mergeConfigFrom(
            __DIR__.'/../config/twill-cookie-consent.php', 'twill-cookie-consent'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        // Register the blocks and repeaters directory.
        parent::registerBlocksDirectory(__DIR__.'/../resources/views/twill/blocks');
        parent::registerRepeatersDirectory(__DIR__.'/../resources/views/twill/repeaters');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/cookie-consent.php');

        // Load the package config file.
        $this->mergeConfigFrom(__DIR__.'/../config/twill-cookie-consent.php', 'twill-cookie-consent');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'twill-cookie-consent');

        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/twill-cookie-consent'),
        ], 'twill-cookie-consent-translations');

        // Register blade directives.
        CookieHelper::registerDirectives();

        // Load package views.
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'twill-cookie-consent');

        // Register the package view composers.
        View::composer('twill-cookie-consent::components.cookie-consent', ConsentComposer::class);
        View::composer('twill-cookie-consent::components.stylesheet', ConsentComposer::class);
        View::composer('twill-cookie-consent::components.head-scripts', ScriptComposer::class);
        View::composer('twill-cookie-consent::components.body-scripts', ScriptComposer::class);
        View::composer('twill-cookie-consent::components.footer-scripts', ScriptComposer::class);

        // Publish the package assets css and js.
        $this->publishes([
            __DIR__.'/../build' => public_path('vendor/twill-cookie-consent'),
        ], 'twill-cookie-consent-assets');

        // Publish the config file
        $this->publishes([
            __DIR__.'/../config/twill-cookie-consent.php' => config_path('twill-cookie-consent.php'),
        ], 'twill-cookie-consent-config');
    }
}
