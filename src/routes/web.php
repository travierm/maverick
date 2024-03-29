<?php

Route::get('maverick', function(){
    return 'Maverick has been installed successfully!';
});


Route::middleware(['web'])->group(function() {

    if(!config('maverick.models')) {
        return;
    }

    foreach(config('maverick.models') as $modelName)
    {
        $modelName = strtolower($modelName);

        Route::get("$modelName/list", 'Travierm\Maverick\Http\Controllers\FormController@list')->name($modelName . '/list');
        Route::get("$modelName/create", 'Travierm\Maverick\Http\Controllers\FormController@create')->name($modelName . '/create');
        Route::get("$modelName/update/{id}", 'Travierm\Maverick\Http\Controllers\FormController@update')->name($modelName . '/update');
        Route::get("$modelName/delete/{id}", 'Travierm\Maverick\Http\Controllers\FormController@delete')->name($modelName . '/delete');

        Route::post("$modelName/create", 'Travierm\Maverick\Http\Controllers\FormController@postCreate');
        Route::post("$modelName/update/{id}", 'Travierm\Maverick\Http\Controllers\FormController@postUpdate');

        if($modelName ) {
            //Register Breadcrumbs
            //route("$modelName/list");
            Breadcrumbs::for($modelName . "/list", function ($trail) use($modelName) {
                $trail->push(ucfirst($modelName), route("$modelName/list"));
            });

            Breadcrumbs::for("$modelName/create", function ($trail)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Create', route("$modelName/create"));
            });

            Breadcrumbs::for("$modelName/update", function ($trail, $id)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Update', route("$modelName/update", $id));
            });
        }

    }
});

?>