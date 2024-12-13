<?php

require 'vendor/autoload.php';

$faker = Faker\Factory::create('pt_BR');

$fileUsersPath = 'users-fake.csv';
$fileAddressesPath = 'address-and-users-fake.csv';
$maxAddressesPerUser = 3;

$headers = ['Nome Completo', 'CPF', 'CEP', 'Endereco Secundario', 'Plus Code', 'Numero', 'Estado', 'Cidade', 'Endereco Principal', 'Favoritado como'];
$secondaryAddresses = ['apartamento', 'casa', 'kitnet'];
$statesCities = [
    'SP' => ['São Paulo', 'Campinas', 'Santos'],
    'RJ' => ['Rio de Janeiro', 'Niterói', 'Petrópolis'],
    'MG' => ['Belo Horizonte', 'Uberlândia', 'Contagem'],
    'DF' => ['Brasília']
];
$favorites = ['true', 'false'];

if (!file_exists($fileUsersPath)) {
    die("Erro: O arquivo $fileUsersPath não foi encontrado. Certifique-se de que ele está no diretório correto.\n");
}

$users = array_map(function($line) {
    return str_getcsv($line, ';');
}, file($fileUsersPath));

array_shift($users);

$file = fopen($fileAddressesPath, 'w');

fwrite($file, implode(',', $headers) . PHP_EOL);

foreach ($users as $user) {
    if (count($user) < 2) {
        continue;
    }

    list($name, $cpf) = [$user[0], $user[1]];

    $numAddresses = rand(1, $maxAddressesPerUser);

    $hasFavorite = false;

    for ($i = 0; $i < $numAddresses; $i++) {
        $state = array_rand($statesCities);
        $city = $statesCities[$state][array_rand($statesCities[$state])];
        
        $cep = $faker->numerify('########');
        $secondaryAddress = $secondaryAddresses[array_rand($secondaryAddresses)];
        $number = rand(1, 9999);
        $mainAddress = $faker->streetName();
        
        if (!$hasFavorite) {
            $favorite = 'true';  
            $hasFavorite = true;
        } else {
            $favorite = 'false';
        }

        $line = implode(';', [$name, $cpf, $cep, $secondaryAddress, '', $number, $state, $city, $mainAddress, $favorite]);
        fwrite($file, $line . PHP_EOL);
    }
}

fclose($file);

echo "Arquivo enderecos.csv criado com sucesso!";
