<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;

class OrganizeWebinarRequest extends FormRequest
{

    /*public function authorize(): bool
    {
        return true;
    }*/
    public function __invoke(): void
    {
        $validated = $this->validate([
            'date' => 'required|string',
            'theme' => 'required|string',
            'link' => 'required|string',
            'nbParticipants' => 'required|integer',
        ]);

        dd($validated);
        $startDate = $this->get('date');
        $theme = $this->get('theme');
        $link = $this->get('link');
        $nbParticipants = $this->get('nbParticipants');


    }

    /*public function messages(): array
    {
        $messages = [
            'date.required' => 'La date est obligatoire !',
            'theme.required' => 'Le theme est obligatoire !',
            'link.required' => 'Le lien est obligatoire !',
            'nbParticipants.required' => 'Le nombre de participants est obligatoire !',
            'nbParticipants.integer' => 'Le nombre de participants est un entier !',

        ];
        return array_merge($messages, parent::messages());
    }

    protected function rules(): array
    {
        return [
            'date' => 'required|string',
            'theme' => 'required|string',
            'link' => 'required|string',
            'nbParticipants' => 'required|integer',
        ];
    }*/
}
