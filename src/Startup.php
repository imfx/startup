<?php

namespace Startup;

use Illuminate\Support\Facades\Route;

class Startup
{

    /**
     * Register the typical authentication routes for an application.
     *
     * @param  array  $options
     * @return void
     */
    public function authRoutes(array $options = [])
    {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
		Route::group(['middleware' => 'can_register'], function () {
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'Auth\RegisterController@register');
        });
        
        $this->resetPassword();

        // Password Confirmation Routes...
        // $this->confirmPassword();

        // Email Verification Routes...
        // if ($options['verify'] ?? false) {
        //     $this->emailVerification();
        // }
    }

    /**
     * Register the typical reset password routes for an application.
     *
     * @return void
     */
    public function resetPassword()
    {
         Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
         Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
         Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
         Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    }

    /**
     * Register the typical confirm password routes for an application.
     *
     * @return void
     */
    public function confirmPassword()
    {
         Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
         Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    }

    /**
     * Register the typical email verification routes for an application.
     *
     * @return void
     */
    public function emailVerification()
    {
         Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
         Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
         Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    }

    /**
     * Create a route group with shared attributes.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
	public function group($callback)
	{
		$attributes = [
			'namespace'  => config('startup.route.namespace'),
			'middleware' => config('startup.route.middleware'),
		];

		Route::group($attributes, $callback);
	}
}
