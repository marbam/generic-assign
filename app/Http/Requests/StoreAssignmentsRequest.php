<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $assignables = explode(",", $this->assignables);
        $assignees = explode(",", $this->assignees);

        return [
            'assignables' => [
                'required',
                'min:4',
                function ($attribute, $value, $fail) use ($assignables, $assignees) {
                    if (count($assignees) != count($assignables)) {
                        $fail("You have a different number of items between your assignables and assignees!");
                    }
                },
            ],
            'assignees' => 'required|min:4'
        ];
    }

    public function messages()
    {
        return [
            'assignables.required' => "Make sure you've entered assignables!",
            'assignables.min' => "Your list of assignables isn't long enough (min: 4 characters)",
            'assignees.required' => "Make sure you've entered assignees!",
            'assignees.min' => "Your list of assignees isn't long enough (min: 4 characters)"
        ];
    }
}
