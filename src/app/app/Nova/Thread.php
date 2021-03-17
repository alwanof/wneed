<?php

namespace App\Nova;

use Bissolli\NovaPhoneField\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Kristories\Qrcode\Qrcode;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class Thread extends Resource
{
    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('QRCODES');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('QRCODE');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Thread::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $slug = ($this->user) ? $this->user->slug : 'noslug';
        return [
            Qrcode::make('QR CODE' . '/' . $slug)
                ->text(env('APP_URL') . '/front/?code=' . $this->slug)
                ->indexSize(48)
                ->detailSize(500)
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Title'), 'title')
                ->sortable()
                ->rules('required', 'max:72'),
            Text::make(__('Slug'), 'slug')->default(function () {
                return Str::random(16);
            })
                ->creationRules('unique:threads,slug')
                ->hideFromIndex()
                ->withMeta(['readonly' => true]),
            PhoneNumber::make(__('Whatsapp'), 'whatsapp'),
            Boolean::make(__('Indoor'), "indoor")
                ->sortable()
                ->default(0),

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
        return [];
    }
}
