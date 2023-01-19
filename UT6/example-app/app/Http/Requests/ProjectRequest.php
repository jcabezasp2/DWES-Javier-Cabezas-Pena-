<?php

namespace App\Http\Requests;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
        return match($this->method()){
         "POST" =>[
            "name" => "required|min:2|max:40|unique:projects",
            "description" => "required|min:5|max:500",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:1024",
            "category_id" => "required|exists:categories,id",
         ],
         "PUT" => [
            "name" => "required|min:2|max:40|unique:projects,name,".$this->route('project')->id,
            "description" => "required|min:5|max:500",
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:1024",
            "category_id" => "required|exists:categories,id",
         ],
    };
    }
}
