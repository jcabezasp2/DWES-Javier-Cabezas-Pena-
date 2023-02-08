<?php

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes  = [
        'name'          => 'User',
        'description'   => 'A user',
        'model'         => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user'
            ],
            'projects' => [
                'type' => Type::listOf(GraphQL::type('Project')),
                'description' => 'List of projects'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::whereId($args['id'])->get();
        }

        if (isset($args['name'])) {
            return User::whereName($args['name'])->get();
        }

        if (isset($args['email'])) {
            return User::whereEmail($args['email'])->get();
        }

        return User::all();
    }
}
