<?php

namespace App\Providers;

use App\Repository\FeesInvoicesRepository;
use App\Repository\FeesInvoicesRepositoryInterface;
use App\Repository\FeesRepository;
use App\Repository\FeesRepositoryInterface;
use App\Repository\ReceiptStudentRepository;
use App\Repository\ReceiptStudentRepositoryInterface;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentGraduatedRepositoryInterface;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentPromotionRepositoryInterface;
use App\Repository\StudentRepository;
use App\Repository\StudentRepositoryInterface;
use App\Repository\TeacherRepository;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
           TeacherRepositoryInterface::class,
            TeacherRepository::class

        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class

        );
        $this->app->bind(
            StudentPromotionRepositoryInterface::class,
            StudentPromotionRepository::class

        );
        $this->app->bind(
            StudentGraduatedRepositoryInterface::class,
            StudentGraduatedRepository::class
        );
        $this->app->bind(
            FeesRepositoryInterface::class,
            FeesRepository::class
        );
        $this->app->bind(
            FeesInvoicesRepositoryInterface::class,
            FeesInvoicesRepository::class
        );
        $this->app->bind(
            ReceiptStudentRepositoryInterface::class,
            ReceiptStudentRepository::class
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
