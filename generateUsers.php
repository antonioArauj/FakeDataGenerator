<?php

require 'vendor/autoload.php';

$faker = Faker\Factory::create('pt_BR');

$numberOfUsers = 3000;

$fileUsersPath = 'users-fake.csv';

$file = fopen($fileUsersPath, 'w');

fwrite($file, "Nome Completo;CPF;Data de nascimento;Genero;E-mail;Numero de Celular;Codigo de indicacao utilizado\n");

for ($i = 0; $i < $numberOfUsers; $i++) {
    $firstName = $faker->firstName();
    $lastName = $faker->lastName();
    $name = $firstName . ' ' . $lastName;

    $cpf = $faker->numerify('###########');

    $birthDate = $faker->date('d/m/Y');

    $gender = $faker->randomElement(['MALE', 'FEMALE', 'PREFER_NOT_SAY']);

    $email = $faker->email();

    $phoneNumber = $faker->phoneNumber();
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    $phoneNumber = substr($phoneNumber, 2);

    $referralCode = '';

    $line = implode(';', [
        $name,
        $cpf,
        $birthDate,
        $gender,
        $email,
        $phoneNumber,
        $referralCode
    ]) . "\n";
    fwrite($file, $line);
}

fclose($file);

echo "Arquivo de usuários gerado com sucesso!";
