<?php

namespace App\Http\Requests;

use App\Rules\ValidMorphMapKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() !== null;
    }

    /**
     * Configure the validator instance.
     *
     * @param  Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            /** @var Validator $validator */
            if ($this->commentableModel()::query()->whereKey($this->input('commentable_id'))->doesntExist()) {
                $validator->errors()->add(
                    'commentable_id',
                    trans('validation.exists', ['attribute' => 'commentable-id'])
                );
            }
        });
    }

    /**
     * @return string|Model
     */
    public function commentableModel(): string
    {
        return Relation::$morphMap[$this->input('commentable_type')];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'commentable_type' => ['required', 'string', new ValidMorphMapKey],
            'commentable_id' => ['required', 'numeric'],
            'comment' => ['required', 'string', 'min:2', 'max:65535']
        ];
    }
}
