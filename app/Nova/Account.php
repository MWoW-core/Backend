<?php

namespace App\Nova;

use App\AccountUsername;
use App\Enums\AccountExpansion;
use App\Rules\ValidHostname;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use SimpleSquid\Nova\Fields\Enum\Enum;

class Account extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Account';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'username', 'email'
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

            Number::make('vp')->sortable(),
            Number::make('dp')->sortable(),

            Text::make('Status')
                ->readonly(),

            Text::make('Username')
                ->sortable()
                ->rules('required', ...AccountUsername::rules())
                ->creationRules('unique:auth.account,username')
                ->updateRules('unique:auth.account,username,{{resourceId}}'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:auth.account,email')
                ->updateRules('unique:auth.account,email,{{resourceId}}'),

            Text::make('Reg. Email', 'reg_mail')
                ->sortable()
                ->rules('required', 'email', 'max:254'),

            Date::make('Joined at', 'joindate')
                ->sortable(),

            DateTime::make('Last login at', 'last_login')
                ->sortable(),

            Text::make('Last IP', 'last_ip')
                ->sortable()
                ->rules('ip'),

            Text::make('Last IP', 'last_ip')
                ->sortable()
                ->rules('ip'),

            Text::make('Last attempt IP', 'last_attempt_ip')
                ->sortable()
                ->rules('ip'),

            Number::make('Failed logins', 'failed_logins'),

            Enum::make('Expansion')->attachEnum(AccountExpansion::class),
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
