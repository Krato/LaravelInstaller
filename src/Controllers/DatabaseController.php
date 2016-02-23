<?php

namespace Infinety\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Infinety\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();
        if($response["status"] == "success"){
            return redirect()->route('LaravelInstaller::migrations')
                ->with(['message' => $response]);
        } else {
            $message = trans('messages.environment.errors');
            return redirect()->back()->withErrors(['message' => $message]);
        }

    }


    public function getMigrations(){

        $directory = base_path("/database/migrations");
        $files = File::allFiles($directory);
        $migrations = [];
        foreach($files as $file){
//            $contents = File::get($file);
//            $posInitial = strpos($contents, 'class');
//            $posFinal = strpos($contents, 'extends');
//            $class = substr($contents, $posInitial, $posFinal);
            $class = $this->readClass($file);
            $migrations[] = $class;
        }
        return view('vendor.installer.migrations', compact('migrations'));
    }


    private function readClass($file){
        $tokens = token_get_all( file_get_contents($file) );
        $class_token = false;
        foreach ($tokens as $token) {
            if ( !is_array($token) ) continue;
            if ($token[0] == T_CLASS) {
                $class_token = true;
            } else if ($class_token && $token[0] == T_STRING) {
                $class_token = false;
                return $token[1];
            }
        }
    }
}
