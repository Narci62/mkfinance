<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\blog\PostController;
use App\Http\Controllers\company\CompanyController;
use App\Http\Controllers\company\StartCompanyController;
use App\Http\Controllers\company\UploadFileController;
use App\Http\Controllers\investor\InvestorController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\main\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Localization;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return Redirect(app()->getLocale());
// });

Route::get('/localization', LocalizationController::class)->name('localization');

Route::middleware(Localization::class)->group(function () {

    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('/about', [MainController::class, 'about'])->name('about');
    Route::get('/contact', [MainController::class, 'contact'])->name('contact');
    Route::get('/faqs', [MainController::class, 'faqs'])->name('faqs');
    Route::get('/how-to-invest', [MainController::class, 'howToInvest'])->name('howToInvest');
    Route::get('/why-invest', [MainController::class, 'whyInvest'])->name('whyInvest');
    Route::get('/juridique-risks', [MainController::class, 'juridique'])->name('juridique');
    Route::get('/our-mission', [MainController::class, 'mission'])->name('mission');
    Route::get('/blog', [MainController::class, 'blog'])->name('blog');

    //project reviews
    Route::get('/projects', [MainController::class, 'projects'])->name('projects');
    Route::get('/project/{id}', [MainController::class, 'viewsProject'])->name('project.view');
    Route::post('/avis/sent', [MainController::class, 'avissent'])->name('avis.sent');




    Route::middleware(['auth', 'account.type:investor'])->group(function () {
        Route::get('in/', [InvestorController::class, 'index'])->name('in');
        Route::get('in/investments', [InvestorController::class, 'investments'])->name('in.investments');
        Route::get('in/wallet', [InvestorController::class, 'wallet'])->name('in.wallet');
        Route::get('in/favorites', [InvestorController::class, 'favorite'])->name('in.favorite');
        Route::get('in/profile', [ProfileController::class, 'editProfile'])->name('in.profile');
        //invest in project
        Route::get('in/start/investment/{id}', [InvestorController::class, 'invest'])->name('in.start.invest');
        Route::post('in/store/investment', [InvestorController::class, 'storeInvest'])->name('in.store.invest');
        // Update Profile
        Route::put('in/profile-avatar', [ProfileController::class, 'updateAvatar'])->name('in.profile.avatar');
        Route::put('in/profile-perso', [ProfileController::class, 'updatePerso'])->name('in.profile.perso');
        Route::put('in/profile-id', [ProfileController::class, 'updateID'])->name('in.profile.id');
        Route::put('in/profile-password', [ProfileController::class, 'updatePassword'])->name('in.profile.password');
        Route::put('in/profile-delete', [ProfileController::class, 'deleteAccount'])->name('in.profile.delete');
        Route::put('in/profile-cancel-delete', [ProfileController::class, 'canceldeleteAccount'])->name('in.profile.canceldelete');
    });

    Route::middleware(['auth', 'account.type:company'])->group(function () {
        Route::get('co/start/1', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config1');
        Route::post('co/start/1', [StartCompanyController::class, 'storeWizardConfig1'])->name('wizard.config1');

        Route::get('co/start/2', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config2');
        Route::post('co/start/2', [StartCompanyController::class, 'storeWizardConfig2'])->name('wizard.config2');

        Route::get('co/start/3', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config3');
        Route::post('co/start/3', [StartCompanyController::class, 'storeWizardConfig3'])->name('wizard.config3');
    });

    Route::middleware(['auth', 'account.type:company'])->prefix('co')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('co');
        Route::get('/profile', [ProfileController::class, 'editProfile'])->name('co.profile');
        Route::get('/preferences', [ProfileController::class, 'editPreferences'])->name('co.preferences');
        Route::get('/security', [ProfileController::class, 'editSecurity'])->name('co.security');
        // Update Profile
        Route::put('/profile-avatar', [ProfileController::class, 'updateAvatar'])->name('co.profile.avatar');
        Route::put('/profile-perso', [ProfileController::class, 'updatePerso'])->name('co.profile.perso');
        Route::put('/profile-id', [ProfileController::class, 'updateID'])->name('co.profile.id');
        Route::put('/profile-password', [ProfileController::class, 'updatePassword'])->name('co.profile.password');
        Route::put('/profile-delete', [ProfileController::class, 'deleteAccount'])->name('co.profile.delete');
        Route::put('/profile-cancel-delete', [ProfileController::class, 'canceldeleteAccount'])->name('co.profile.canceldelete');
        
        /**
         * Company
         */
        
        //start company
        Route::get('/start/1', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config1');
        Route::post('/start/1', [StartCompanyController::class, 'storeWizardConfig1'])->name('wizard.config1');

        Route::get('/start/2', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config2');
        Route::post('/start/2', [StartCompanyController::class, 'storeWizardConfig2'])->name('wizard.config2');

        Route::get('/start/3', [StartCompanyController::class, 'wizardConfig'])->name('wizard.config3');
        Route::post('/start/3', [StartCompanyController::class, 'storeWizardConfig3'])->name('wizard.config3');        

        // manage company
        Route::get('/overview', [CompanyController::class, 'overview'])->name('co.overview');

        //start project writing
        Route::get('/project/start/1', [CompanyController::class, 'create'])->name('co.project1');
        Route::post('/project/start/1', [CompanyController::class, 'storeProject1'])->name('co.project1');

        Route::get('/project/start/2', [CompanyController::class, 'create'])->name('co.project2');
        Route::post('/project/start/2', [CompanyController::class, 'storeProject2'])->name('co.project2');

        Route::get('/project/start/3', [CompanyController::class, 'create'])->name('co.project3');
        Route::post('/project/start/3', [CompanyController::class, 'storeProject3'])->name('co.project3');

        //news
        Route::get('/posts', [PostController::class, 'index'])->name('co.posts');
        Route::get('/post-create', [PostController::class, 'create'])->name('co.newpost');
        Route::post('/post-create', [PostController::class, 'store'])->name('co.newpost');
        Route::get('/post/{id}', [PostController::class, 'show'])->name('co.post');

        //investors
        Route::get('/investors', [CompanyController::class, 'investors'])->name('co.investors');
        Route::get('/investors/{id}', [CompanyController::class, 'investor'])->name('co.investor');

        //wallet
        Route::get('/wallets', [CompanyController::class, 'wallets'])->name('co.wallet');


        


        //upload file 
        Route::post('/upload',[UploadFileController::class,'index'])->name('file.upload');


    });


    //admin
    Route::middleware(['auth', 'account.type:admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
    });



    Route::fallback(function () {
        return response()->view('errors.404', [], 404);
    });


    require __DIR__ . '/auth.php';
});
