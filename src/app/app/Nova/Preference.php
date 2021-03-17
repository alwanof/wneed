<?php

namespace App\Nova;

use App\Nova\Actions\SetPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Preference extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Setting::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'key';
    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Preferences');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Preference');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'key',
    ];
    public static function authorizable()
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Key'), 'key')
                ->sortable()
                ->rules('required', 'max:15'),
            Text::make(__('Value'), 'value')
                ->rules('required', 'max:255'),
            Text::make(__('Current Value'), function () {
                $prefer = auth()->user()->settings[$this->key];
                return $prefer;
            })->onlyOnIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new SetPreference())->onlyOnTableRow(),
        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        $role_id = auth()->user()->roles->first()->id;
        //dd($role_id);
        return $query->whereExists(function ($iquery)  use ($role_id) {
            $iquery->select(DB::raw(1))
                ->from('role_setting')
                ->whereRaw('setting_id = settings.id')
                ->whereRaw('role_id = ' . $role_id);
        });
    }
}
