<?php


namespace App\Providers\ServiceProviders;


use App\Providers\OriginalUserProvider;
use Authorization\Application\Service\Authenticate\AuthenticateService;
use Authorization\Application\Service\User\UserService;
use Authorization\DebugInfrastructure\Persistence\DebugUserFactory;
use Authorization\DebugInfrastructure\Persistence\FileUserRepository;
use Authorization\Domain\Users\UserFactoryInterface;
use Authorization\Domain\Users\UserRepositoryInterface;
use Basic\DebugSupport\Infrastructure\FileRepositoryConfig;
use Basic\DebugSupport\Transaction\NopTransaction;
use Basic\Transaction\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\BcryptHasher;
use Scrum\Application\Service\BackLog\BackLogApplicationService;
use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;
use Scrum\EloquentInfrastructure\Persistence\UserStories\EloquentUserStoryRepository;
use Scrum\EloquentInfrastructure\QueryServices\EloquentBackLogQueryService;

class LocalServiceProvider implements Provider
{
    /** @var Application */
    private $app;

    /**
     * LocalServiceProvider constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function register()
    {
        $this->registerDbConfig();
        $this->registerProviders();
        $this->registerUtilities();
        $this->registerApplications();
        $this->registerInfrastructures();
    }

    public function boot()
    {
        $debugPersistenceDirectoryFullPath = storage_path("debug\\persistence");
        FileRepositoryConfig::$basicDirectoryFullPath = $debugPersistenceDirectoryFullPath;
    }

    private function registerDbConfig() {
        $this->app->bind(Transaction::class, NopTransaction::class);
    }

    private function registerProviders() {
        $this->app->bind(OriginalUserProvider::class);
    }

    private function registerUtilities() {
        $this->app->bind(Hasher::class, BcryptHasher::class);
    }

    private function registerApplications()
    {
        $this->app->bind(BackLogApplicationService::class);

        // Auth
        $this->app->bind(AuthenticateService::class);
        $this->app->bind(UserService::class);
    }

    private function registerInfrastructures()
    {
        $this->app->bind(BackLogQueryServiceInterface::class, EloquentBackLogQueryService::class);
        $this->app->bind(UserStoryRepositoryInterface::class, EloquentUserStoryRepository::class);

        // Auth
        $this->app->bind(UserFactoryInterface::class, DebugUserFactory::class);
        $this->app->bind(UserRepositoryInterface::class, FileUserRepository::class);
    }
}
