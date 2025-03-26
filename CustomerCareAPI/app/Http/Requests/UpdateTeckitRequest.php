<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeckitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'content_vusial' => 'nullable|string',
            'status' => 'sometimes|required|in:création,suivi,fermeture',
            'client_id' => 'sometimes|required|exists:users,id',
            'agent_id' => 'sometimes|required|exists:users,id',
        ];
    }
}
