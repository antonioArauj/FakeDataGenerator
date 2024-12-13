<?php

require 'vendor/autoload.php';

$faker = Faker\Factory::create('pt_BR');

$numberOfRecargas = 3000;
$fileUsersPath = 'users-fake.csv';
$fileRecargasPath = 'recargas-fake.csv';

$file = fopen($fileRecargasPath, 'w');

fwrite($file, "Nome Completo;CPF;Pedido Recarga;Numero da Transacao;Status;Data e Hora do Pedido;Forma de Pagamento;Total;Celular Recarregado\n");

if (!file_exists($fileUsersPath)) {
    die("Erro: O arquivo $fileUsersPath não foi encontrado. Certifique-se de que ele está no diretório correto.\n");
}

$users = array_map(function($line) {
    return str_getcsv($line, ';');
}, file($fileUsersPath));

array_shift($users);

foreach ($users as $user) {
    if (count($user) < 2) {
        continue; 
    }

    list($name, $cpf) = [$user[0], $user[1]];

    $rechargeOrder = $faker->uuid;
    $transactionNumber = $faker->numerify('##########');
    
    $status = $faker->randomElement(['FINISHED', 'PENDING', 'FAILED']);
    $dateTimeOrder = $faker->dateTimeThisYear()->format('Y-m-d H:i:s') . ' -0400';

    $paymentMethod = $faker->randomElement(['WALLET', 'PIX', 'PIX_OWN_ACCOUNT', 'PIX_THIRD']);
    $total = $faker->randomNumber(3);


    $phoneRecharged = $faker->phoneNumber();
    $phoneRecharged = preg_replace('/[^0-9]/', '', $phoneRecharged);
    $phoneRecharged = substr($phoneRecharged, 2);


    $line = implode(';', [
        $name,
        $cpf,
        $rechargeOrder,
        $transactionNumber,
        $status,
        $dateTimeOrder,
        $paymentMethod,
        $total,
        $phoneRecharged
    ]) . "\n";
    fwrite($file, $line);
}

fclose($file);

echo "Arquivo de recargas gerado com sucesso!";
