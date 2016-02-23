<?php

namespace Infinety\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Http\Request;

class EnvironmentManager
{
    /**
     * @var string
     */
    private $envPath;

    /**
     * @var string
     */
    private $envExamplePath;

    /**
     * @var array
     */
    private $env;

    /**
     * Set the .env and .env.example paths.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
        $this->env = $this->getEnvContent();
    }

    /**
     * Get the content of the .env file.
     *
     * @return string
     */
    public function getEnvContent()
    {
        if (!file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file($this->envPath);
    }

    /**
     * Save the edited content to the file.
     *
     * @param Request $input
     * @return string
     */
    public function saveFile()
    {
        $message = trans('messages.environment.success');

        try {
            file_put_contents($this->envPath, implode($this->env));
        }
        catch(Exception $e) {
            $message = trans('messages.environment.errors');
        }

        return $message;
    }


    /**
     * Set the database setting of the .env file.
     *
     * @param Illuminate\Http\Request $request
     * @return string
     */
    public function setDatabaseSetting(Request $request){

        $this->set('DB_DATABASE', $request->database);
        $this->set('DB_USERNAME', $request->user);
        $this->set('DB_PASSWORD',$request->password);

        $this->set('DB_HOST', $request->host);

        return $this->saveFile();
    }

    /**
     * Set .env element.
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    private function set($key, $value)
    {
        $this->env = array_map(function($item) use($key, $value){
            if(strpos($item, $key) !== false) {
                $start = strpos($item, '=') + 1;
                $item = substr_replace($item, $value . "\n", $start);
            };
            return $item;
        }, $this->env);
    }

}