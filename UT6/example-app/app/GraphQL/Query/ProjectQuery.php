<?php


namespace App\GraphQL\Query;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProjectQuery extends Query
{
    protected $attributes = [
        'name' => 'project',
    ];

    public function type(): Type
    {
        return GraphQL::type('Project');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Project::findOrFail($args['id']);
    }
}
