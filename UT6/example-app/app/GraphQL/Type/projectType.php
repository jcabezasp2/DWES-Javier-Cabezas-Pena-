<?php

namespace App\GraphQL\Type;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class projectType extends GraphQLType
{
    protected $attributes  = [
        'name'          => 'Project',
        'description'   => 'A project',
        'model'         => Project::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the project',
            ],
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
                'type' => GraphQL::type('User'),
                'description' => 'user_id of project'
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return Project::whereId($args['id'])->get();
        }

        if (isset($args['name'])) {
            return Project::whereName($args['name'])->get();
        }

        if (isset($args['user_id'])) {
            return Project::whereDescription($args['user_id'])->get();
        }

        return Project::all();
    }
}
