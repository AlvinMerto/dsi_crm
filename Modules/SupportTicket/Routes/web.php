<?php

    use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'PlanModuleCheck:SupportTicket'], function ()
{

    Route::resource('support-tickets', 'SupportTicketController')->middleware(['auth']);
    Route::get('support-tickets/create/{type}/{id}', 'SupportTicketController@create')->name('support-tickets.create')->middleware(['auth']);
    Route::post('contact/get/detail', 'SupportTicketController@contactdetail')->name('contact.get.detail')->middleware(['auth']);

    Route::resource('ticket-category', 'TicketCategoryController')->middleware(['auth']);
    Route::resource('knowledge-category', 'KnowledgebaseCategoryController')->middleware(['auth']);
    Route::resource('support-ticket-faq', 'FaqController')->middleware(['auth']);
    Route::resource('support-ticket-knowledge', 'KnowledgeController')->middleware(['auth']);

    // dashboard
    Route::get('dashboard/support-ticket',['as' => 'dashboard.support-tickets','uses' =>'DashboardController@index'])->middleware(['auth']);
    Route::post('/custom-fields',['as' => 'support-ticket.store','uses' =>'SupportTicketController@storeCustomFields'])->middleware(['auth']);


    Route::get('support-tickets/search/{status?}',['as' => 'support-tickets.search','uses' =>'SupportTicketController@index']);
    Route::delete('support-tickets-attachment/{tid}/destroy/{id}',['as' => 'support-tickets.attachment.destroy','uses' =>'SupportTicketController@attachmentDestroy']);
    Route::post('support-ticket/{id}/conversion',['as' => 'support-ticket.conversion.store','uses' =>'ConversionController@store']);
    Route::post('support-ticket/{id}/note',['as' => 'support-ticket.note.store','uses' =>'SupportTicketController@storeNote']);
    Route::post('support-ticket/setting/store',['as' => 'support-ticket.setting.store','uses' =>'SupportTicketController@setting']);
    Route::get('support-ticket/grid/{status?}', 'SupportTicketController@grid')->name('support-tickets.grid');

     //knowledgebadge import
     Route::get('knowledge/import/export', 'KnowledgeController@fileImportExport')->name('knowledge.file.import')->middleware(['auth']);
     Route::post('knowledge/import', 'KnowledgeController@fileImport')->name('knowledge.import')->middleware(['auth']);
     Route::get('knowledge/import/modal', 'KnowledgeController@fileImportModal')->name('knowledge.import.modal')->middleware(['auth']);
     Route::post('knowledge/data/import/', 'KnowledgeController@knowledgeImportdata')->name('knowledge.import.data')->middleware(['auth']);

    // Faq import
    Route::get('faq/import/export', 'FaqController@fileImportExport')->name('faq.file.import')->middleware(['auth']);
    Route::post('faq/import', 'FaqController@fileImport')->name('faq.import')->middleware(['auth']);
    Route::get('faq/import/modal', 'FaqController@fileImportModal')->name('faq.import.modal')->middleware(['auth']);
    Route::post('faq/data/import/', 'FaqController@faqImportdata')->name('faq.import.data')->middleware(['auth']);
});

Route::get('{slug}/support-ticket',['as' => 'support-ticket','uses' =>'PublicTicketController@create']);
Route::post('{slug}/ticket-store',['as' => 'ticket.store','uses' =>'PublicTicketController@store']);
Route::get('{slug}/support-ticket/{id}', ['as' => 'ticket.view','uses' =>'PublicTicketController@index']);
Route::post('{slug}/support-ticket/{id}', ['as' => 'ticket.reply','uses' =>'PublicTicketController@reply']);
Route::get('{slug}/support-ticket-search', ['as' => 'get.ticket.search','uses' =>'PublicTicketController@search']);
Route::post('{slug}/support-ticket/post/search', ['as' => 'ticket.search','uses' =>'PublicTicketController@ticketSearch']);

Route::get('{slug}/faqs',['as' => 'faqs','uses' =>'PublicTicketController@faq']);
Route::get('{slug}/knowledge',['as' => 'knowledge','uses' =>'PublicTicketController@knowledge']);
Route::get('{slug}/knowledgedesc', ['as' => 'knowledgedesc','uses' =>'PublicTicketController@knowledgeDescription']);

