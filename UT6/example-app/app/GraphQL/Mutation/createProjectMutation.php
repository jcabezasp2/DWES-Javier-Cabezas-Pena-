<?php


namespace App\GraphQL\Mutation;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use \App\GraphQL\Query\UserQuery;

class CreateProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProject',
        'description' => 'Creates a project'
    ];

    public function type(): Type
    {
        return GraphQL::type('Project');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of project',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'description of project'
            ],
            'image' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'image of project'
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'user_id of project'
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'category_id of project'
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $project = new Project();
        if (!isset($args['user_id'])) {
            $args['user_id'] = auth()->user()->id;
        }
        $project->fill($args);
        $project->save();

        return $project;
    }
}
