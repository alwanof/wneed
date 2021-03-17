<?php

namespace App\Nova;

use Bissolli\NovaPhoneField\PhoneNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Khalin\Nova\Field\Link;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use phpDocumentor\Reflection\Types\This;


class Order extends Resource
{
    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Orders');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Order');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'phone',
        'dist'

    ];

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
            Text::make(__('Slug'), 'slug')->onlyOnDetail(),
            Badge::make(__('Status'), 'status', function () {
                return $this->statusLabel($this->status);
            })
                ->map([
                    $this->statusLabel(0) => 'danger',
                    $this->statusLabel(1) => 'warning',
                    $this->statusLabel(2) => 'info',
                    $this->statusLabel(2) => 'success',
                ]),
            Text::make(__('Name'), 'name')
                ->rules('required', 'max:255'),
            /*Text::make('Name', 'name')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    $model->{$attribute} = Str::title($request->input($attribute));
                }),*/
            PhoneNumber::make(__('Phone'), 'phone'),
            Text::make(__('Dist'), 'dist'),
            BelongsTo::make(__('Driver'), 'driver', 'App\Nova\Driver'),
            BelongsTo::make(__('Rest'), 'rest', 'App\Nova\User'),
            BelongsTo::make(__('Agent'), 'actor', 'App\Nova\User'),
            Text::make(__('Email'), 'email')->onlyOnDetail(),
            Text::make(__('Address'), 'address')->onlyOnDetail(),
            Text::make(__('Aprt'), 'aprt')->onlyOnDetail(),
            Text::make(__('House'), 'house')->onlyOnDetail(),
            Text::make(__('Bell'), 'bell')->onlyOnDetail(),
            Text::make(__('Total'), 'total')->onlyOnDetail(),
            Link::make(__('location'), function () {
                return __('Google Map');
            })
                ->url(function () {
                    return "https://www.google.com/maps/?q=" . $this->lat . "," . $this->lng;
                })
                ->icon()
                ->blank()
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

    private function statusLabel($status)
    {
        $label = '#E';
        switch ($status) {
            case 0:
                $label = __('New');
                break;
            case 1:
                $label = __('Preparing');
                break;
            case 2:
                $label = __('On Way');
                break;

            case 3:
                $label = __('Delivered');
                break;
        }
        return $label;
    }
}
