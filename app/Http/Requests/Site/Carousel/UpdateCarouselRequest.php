<?php

namespace App\Http\Requests\Site\Carousel;

use App\Models\Site\SiteCarousel;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarouselRequest extends FormRequest
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
            'title'     => 'nullable|string|max:100',
            'text'      => 'nullable|string|max:1000',
            'name_link' => 'nullable|string|max:100|required_with:url_link',
            'url_link'  => 'nullable|string|url|required_with:name_link',
            'image'     => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('image', 'required', function ($input) {
            $model = SiteCarousel::find($this->route('id'));
            return !$model || !$model->image;
        });
    }

    public function messages(): array
    {
        return [
            'title.max'               => 'O título pode ter no máximo :max caracteres.',
            'text.max'                => 'O texto pode ter no máximo :max caracteres.',
            'name_link.required_with' => 'O nome do link é obrigatório quando a URL do link está presente.',
            'name_link.max'           => 'O nome do link pode ter no máximo :max caracteres.',
            'url_link.required_with'  => 'A URL do link é obrigatória quando o nome do link está presente.',
            'url_link.url'            => 'A URL do link deve ser um endereço URL válido.',
            'url_link.max'            => 'A URL do link pode ter no máximo :max caracteres.',
            'image.file'              => 'A imagem deve ser um arquivo válido.',
            'image.image'             => 'A imagem deve ser um arquivo de imagem válido.',
            'image.mimes'             => 'A imagem deve ser um arquivo do tipo: :values.',
            'image.max'               => 'A imagem não pode ser maior que :max kilobytes.',
            'image.required'          => 'A imagem é obrigatória.',
        ];
    }
}
