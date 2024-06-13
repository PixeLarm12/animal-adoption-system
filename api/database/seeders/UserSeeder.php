<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Lucas Ramos Domingues',
                'email' => 'lucas@gmail.com',
                'password' => bcrypt('221025847'),
                'cpf' => '12312312300',
                'birth_date' => '2001-01-01',
                'phones' => [
                    'area' => '14',
                    'phone' => '999999999',
                ],
                'addresses' => [
                    'street' => 'Rua dos Limoeiros',
                    'number' => '101',
                    'zipcode' => '12345678',
                    'neighborhood' => 'Bairro da Subida Alta',
                    'complement' => '',
                ]
            ],
            [
                'name' => 'Milena Toledo de Araújo',
                'email' => 'milena@gmail.com',
                'password' => bcrypt('221024743'),
                'cpf' => '12312312301',
                'birth_date' => '2002-02-02',
                'phones' => [
                    'area' => '14',
                    'phone' => '888888888',
                ],
                'addresses' => [
                    'street' => 'Rua dos Limoeiros',
                    'number' => '102',
                    'zipcode' => '12345677',
                    'neighborhood' => 'Bairro da Subida Alta',
                    'complement' => 'Ap. 14',
                ]
            ],
            [
                'name' => 'Ana Beatriz Martins Ribeiro',
                'email' => 'anabeatriz@gmail.com',
                'password' => bcrypt('221022473'),
                'cpf' => '12312312302',
                'birth_date' => '2003-03-03',
                'phones' => [
                    'area' => '14',
                    'phone' => '777777777',
                ],
                'addresses' => [
                    'street' => 'Rua dos Limoeiros',
                    'number' => '103',
                    'zipcode' => '12345676',
                    'neighborhood' => 'Bairro da Subida Alta',
                    'complement' => '',
                ]
            ],
            [
                'name' => 'Guilherme Gumiero da Nóbrega',
                'email' => 'guilhermegumiero@gmail.com',
                'password' => bcrypt('221025634'),
                'cpf' => '12312312303',
                'birth_date' => '2004-04-04',
                'phones' => [
                    'area' => '14',
                    'phone' => '666666666',
                ],
                'addresses' => [
                    'street' => 'Rua dos Limoeiros',
                    'number' => '104',
                    'zipcode' => '12345675',
                    'neighborhood' => 'Bairro da Subida Alta',
                    'complement' => '',
                ]
            ],
            [
                'name' => 'Pedro Henrique Roratto',
                'email' => 'pedrororatto@gmail.com',
                'password' => bcrypt('221026932'),
                'cpf' => '12312312304',
                'birth_date' => '2005-05-05',
                'phones' => [
                    'area' => '14',
                    'phone' => '555555555',
                ],
                'addresses' => [
                    'street' => 'Rua dos Limoeiros',
                    'number' => '105',
                    'zipcode' => '12345674',
                    'neighborhood' => 'Bairro da Subida Alta',
                    'complement' => 'Ap. 25',
                ]
            ],
        ];

        foreach($users as $user) {
            $user = User::create([
                "name" => $user["name"],
                "email" => $user["email"],
                "password" => $user["password"],
                "cpf" => $user["cpf"],
                "birth_date" => $user["birth_date"],
            ]);

            $user->phones()->createMany($user['phones']);
            $user->addresses()->createMany($user['addresses']);
        }
    }
}
