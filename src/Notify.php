<?php

namespace Onicial\LaravelBulmaNotifications;

use Illuminate\Session\Store;

class Notify
{
    /**
     * Session storage.
     */
    protected $session;

    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config;

    public function __construct(Store $session)
    {
        $this->setDefaultConfig();

        $this->session = $session;
    }

    /**
     * Sets all default config options for an alert.
     *
     * @return void
     */
    protected function setDefaultConfig()
    {
        $this->config = [
            'timer' => env('ALERT_TIMER', 5000),
            'title' => '',
            'text' => '',
        ];
    }

    /**
     * Flash a message.
     *
     * @param  string $title
     * @param  string $text
     * @param  array  $type
     *
     * @return void
     */
    public function alert($title = '', $text = '', $type = null)
    {
        $this->config['title'] = $title;

        $this->config['text'] = $text;

        if (!is_null($type)) {
            $this->config['type'] = $type;
        }

        $this->flash();

        return $this;
    }

    /*
     **
     * Display a success typed alert message with a text and a title.
     *
     * @param string $title
     * @param string $text
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function success($title = '', $text = '')
    {
        $this->alert($title, $text, 'primary');

        return $this;
    }

    /*
     **
     * Display a info typed alert message with a text and a title.
     *
     * @param string $title
     * @param string $text
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function info($title = '', $text = '')
    {
        $this->alert($title, $text, 'info');

        return $this;
    }

    /*
     **
     * Display a warning typed alert message with a text and a title.
     *
     * @param string $title
     * @param string $text
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function warning($title = '', $text = '')
    {
        $this->alert($title, $text, 'warning');

        return $this;
    }

    /*
     **
     * Display a error typed alert message with a text and a title.
     *
     * @param string $title
     * @param string $text
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function error($title = '', $text = '')
    {
        $this->alert($title, $text, 'danger');

        return $this;
    }

    /*
     **
     * Display a html typed alert message with html code.
     *
     * @param string $title
     * @param string $code
     * @param string $type
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function html($code = '', $type = '', $title = '')
    {
        $this->config['title'] = $title;

        $this->config['html'] = $code;

        if (!is_null($type)) {
            $this->config['type'] = $type;
        }

        $this->flash();

        return $this;
    }

    /*
     **
     * can any alert after param $milliseconds
     *
     * @param bool $milliseconds
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function autoClose($milliseconds = 5000)
    {
        $this->config['timer'] = $milliseconds;

        $this->flash();

        return $this;
    }

    /**
     * Display close button on alert
     *
     * @param string $closeButtonAriaLabel
     *
     * @return Onicial\LaravelBulmaNotifications\Notify::alert();
     */
    public function showCloseButton($closeButtonAriaLabel = 'aria-label')
    {
        $this->config['showCloseButton'] = true;
        $this->config['closeButtonAriaLabel'] = $closeButtonAriaLabel;

        $this->flash();

        return $this;
    }

    /**
     *
     * Hide close button from alert or toast
     *
     * @return $this;
     */
    public function hideCloseButton()
    {
        $this->config['showCloseButton'] = false;
        $this->flash();

        return $this;
    }

    /**
     * Flash the config options for alert.
     *
     * @return void
     */
    public function flash()
    {
        foreach ($this->config as $key => $value) {
            $this->session->flash("alert.config.{$key}", $value);
        }
        $this->session->flash('alert.config', $this->buildConfig());
    }

    /**
     * Convert any alert modal to html
     *
     * @return $this;
     */
    public function toHtml()
    {
        $this->config['html'] = $this->config['text'];
        unset($this->config['text']);
        $this->flash();
        return $this;
    }

    /**
     * Build Flash config options for flashing.
     *
     * @return void
     */
    public function buildConfig()
    {
        $config = $this->config;

        return json_encode($config);
    }
}