<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//
// use App\Models\UmdTerm;
// use App\Models\UmdTermTaxonomy;
use App\Models\UmdOption;
use App\Models\UmdComment;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// $newsTerm = UmdTerm::where('name', 'الفضاء الاخباري')->first();
		// $newsMenu = UmdTermTaxonomy::where('parent', $newsTerm->term_id)->get();
		$newComs = UmdComment::where('comment_approved', 0)->count();
		$fbLink = UmdOption::where('option_name', 'fb_link')->first()->option_value;
		$twLink = UmdOption::where('option_name', 'tw_link')->first()->option_value;
		$options = UmdOption::get();


        view()->share(compact("fbLink", "twLink", "newComs", "options"));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		if ($this->app->environment() == 'local') {
	        $this->app->register('Iber\Generator\ModelGeneratorProvider');
	    }
    }
}
