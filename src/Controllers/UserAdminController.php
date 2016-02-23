<?php

namespace Infinety\LaravelInstaller\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;


class UserAdminController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function createAdmin()
    {
        return view('vendor.installer.admin_user');
    }

    public function storeAdmin(Request $input){
        $this->validate($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        dump($input->all());
        dd();
    }
}
