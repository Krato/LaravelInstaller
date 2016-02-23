<?php

namespace Infinety\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Infinety\LaravelInstaller\Helpers\EnvironmentManager;
use Validator;

class EnvironmentController extends Controller
{

    /**
     * @var EnvironmentManager
     */
    protected $EnvironmentManager;

    /**
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->EnvironmentManager = $environmentManager;
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment()
    {
        $host = env('DB_HOST');
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        return view('vendor.installer.environment', compact('host', 'database', 'username', 'password'));
    }


    /**
     * Processes the newly saved environment configuration and redirects back.
     *
     * @param Request $input
     * @param Redirector $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $input, Redirector $redirect)
    {



        $this->validate($input, [
            'database' => 'required',
            'user' => 'required',
            'password' => 'required',
            'host' => 'required',
        ]);

        $message = $this->EnvironmentManager->setDatabaseSetting($input);

//        $message = $this->EnvironmentManager->saveFile($input);

        return $redirect->route('LaravelInstaller::database')
                        ->with(['message' => $message]);
    }

}
