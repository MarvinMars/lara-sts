<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gameid'      => 'required|max:32',
            'oppcode'     => 'nullable|max:32',
            'oppid'       => 'nullable|max:32',
            'oppname'     => 'nullable|max:32',
            'site'        => 'nullable|max:255',
            'stadium'     => 'nullable|max:32',
            'quarters'    => 'nullable|integer',
            'ownscore'    => 'nullable|integer',
            'attend'      => 'nullable|integer',
            'duration'    => 'nullable|date',
            'start'       => 'nullable|date',
            'date'        => 'nullable|date',
            'leaguegame'  => 'boolean|required',
            'neutralgame' => 'boolean|required',
            'nitegame'    => 'boolean|required',
            'postseason'  => 'boolean|required',
            'homeaway'    => 'boolean|required',
            'is_visible'  => 'boolean|required',
            'number'      => 'nullable|number',
            'teams'       => 'nullable|array',
            'sport_id'    => 'required|exists:sports,id',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
