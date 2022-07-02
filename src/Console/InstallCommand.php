<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Console;

use Illuminate\Console\Command;
use Larva\Admin\AdminTablesSeeder;

/**
 * 安装脚本
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected string $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->initDatabase();

        $this->initAdminDirectory();

        $this->info('Done.');
    }

    /**
     * Create tables and seed it.
     */
    public function initDatabase(): void
    {
        $this->call('migrate');
        $userModel = config('admin.database.users_model');
        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
        }
    }

    /**
     * Set admin directory.
     *
     * @return void
     */
    protected function setDirectory(): void
    {
        $this->directory = config('admin.directory');
    }

    /**
     * Initialize the admin directory.
     *
     * @return void
     */
    protected function initAdminDirectory(): void
    {
        $this->setDirectory();

        if (is_dir($this->directory)) {
            $this->warn("{$this->directory} directory already exists !");

            return;
        }
        $this->makeDir('/');

        $this->line('<info>Admin directory was created:</info> ' . str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');

        $this->createHomeController();
        $this->createAuthController();

        $this->createBootstrapFile();
        $this->createRoutesFile();
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createHomeController(): void
    {
        $homeController = $this->directory . '/Controllers/HomeController.php';
        $contents = $this->getStub('HomeController');

        $this->laravel['files']->put(
            $homeController,
            str_replace(
                'DummyNamespace',
                $this->namespace('Controllers'),
                $contents
            )
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $homeController));
    }

    /**
     * Create AuthController.
     *
     * @return void
     */
    public function createAuthController(): void
    {
        $authController = $this->directory . '/Controllers/AuthController.php';
        $contents = $this->getStub('AuthController');

        $this->laravel['files']->put(
            $authController,
            str_replace(
                'DummyNamespace',
                $this->namespace('Controllers'),
                $contents
            )
        );
        $this->line('<info>AuthController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    public function createSettingsController(): void
    {
        $authController = $this->directory . '/Controllers/SystemSettingsController.php';
        $contents = $this->getStub('SystemSettingsController');
        $this->laravel['files']->put(
            $authController,
            str_replace(
                'DummyNamespace',
                $this->namespace('Controllers'),
                $contents)
        );
        $this->line('<info>SystemSettingsController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    /**
     * @param string|null $name
     * @return string
     */
    protected function namespace(string $name = null): string
    {
        $base = str_replace('\\Controllers', '\\', config('admin.route.namespace'));
        return trim($base, '\\').($name ? "\\{$name}" : '');
    }

    /**
     * Create bootstrap file.
     *
     * @return void
     */
    protected function createBootstrapFile(): void
    {
        $file = $this->directory . '/bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile(): void
    {
        $file = $this->directory . '/routes.php';

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('admin.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    /**
     * Get stub contents.
     *
     * @param string $name
     * @return string
     */
    protected function getStub(string $name): string
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/$name.stub");
    }

    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir(string $path = ''): void
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
