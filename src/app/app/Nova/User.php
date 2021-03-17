<?php

namespace App\Nova;

use Ctessier\NovaAdvancedImageField\AdvancedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Silvanite\NovaToolPermissions\Role;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('User');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email',
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
            ID::make()->sortable(),
            Avatar::make(__('Avatar'), 'avatar')->onlyOnIndex(),
            AdvancedImage::make(__('Avatar'), 'avatar')->croppable(1 / 1)->resize(320)->disk('public')->path('users')->hideFromIndex(),

            Text::make(__('Name'), "name")
                ->sortable()
                ->rules('required', 'max:255'),
            Slug::make(__('Slug'), 'slug')
                ->from('Name')
                ->creationRules('unique:users,slug')
                ->hideFromIndex()
                ->withMeta(['readonly' => true]),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            Text::make(__('Expiration Date'), 'expiration_date')
                ->displayUsing(function ($expirationDate) {
                    return ($expirationDate) ? $expirationDate->diffForHumans() : '-';
                })
                ->onlyOnIndex(),
            Text::make(__('Level'), 'level', function () {

                return $this->getLevel($this->level);
            })
                ->onlyOnIndex(),
            Select::make(__('Level'), 'level')->options($this->getLevel())
                ->creationRules('required')
                ->onlyOnForms()
                ->hideWhenUpdating()
                ->displayUsingLabels(),
            BelongsToMany::make(__('Roles'), 'roles', Role::class),
            BelongsTo::make(__('Parent'), 'parent', User::class)->hideCreateRelationButton()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Agent'), 'agent', User::class)->hideCreateRelationButton()->hideWhenCreating()->hideWhenUpdating(),
            //BelongsTo::make('Agent', 'agent', User::class),
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

    private function getLevel($key = 99)
    {
        if ($key != 99) {
            return __(Config::get('const.levels')[$key]);
        }

        switch (auth()->user()->level) {
            case 0:
                $results = Config::get('const.levels');
                $res = [];
                foreach ($results as $result) {
                    $res[] = __($result);
                }

                return $res;
                break;
            case 1:
                $results = Config::get('const.levels');
                $res = [];
                foreach ($results as $result) {
                    $res[] = __($result);
                }
                unset($res[0]);
                unset($res[1]);
                return $res;
                break;
        }
    }
}
