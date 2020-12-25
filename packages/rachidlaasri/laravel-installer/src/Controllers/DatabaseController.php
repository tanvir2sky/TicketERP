<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use App\User;
use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database()
    {
        $response = $this->databaseManager->migrateAndSeed();
        User::create([
            'first_name' => session('admin_name'),
            'email' => session('admin_email'),
            'password' => session('admin_password'),
            'role' => User::ADMIN
        ]);
        return redirect()->route('LaravelInstaller::final')
                         ->with(['message' => $response]);
    }
}
