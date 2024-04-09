<?php

namespace App\Http\Requests;

use App\Models\Podcast;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PodcastRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => [
                'required',
                Rule::when($this->routeIs('admin.podcast.store'), [Rule::unique('podcasts', 'slug')]),
                Rule::when($this->routeIs('admin.podcast.update'), [Rule::unique('podcasts', 'slug')->ignore($this->podcast)]),
            ],
            'episode' => [
                Rule::when($this->routeIs('admin.podcast.update'), ['required']),
            ],
            'duration' => ['required'],
            'path' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?: $this->title),
            'status' => (int) $this->status,
        ]);

        if (!$this->episode && $this->routeIs('admin.podcast.store')) {
            $this->merge([
                'episode' => Podcast::newEpisode(),
            ]);
        }
    }
}
