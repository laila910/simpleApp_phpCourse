<?php

declare(strict_types = 1);

// Your Code
function getTransactionFiles(string $dirPath):array{
    $files=[];
    foreach(scandir($dirPath) as $file){
        // var_dump($file);
        if(is_dir($file)){
            continue;
        }
        $files[]=$dirPath . $file;
    }
    return $files;
}
function getTransactions(string $fileName):array{
    if(! file_exists($fileName)){
        trigger_error('File "' . $fileName . '"does not exist',E_USER_ERROR);

    }
    $file=fopen($fileName,'r');
    fgetcsv($file);
    $transations =[];
    while(($transation =fgetcsv($file)) !== false){
        // $transations[]=$transation;
       
        $transations[]=extractTransaction($transation);
    }
    return $transations;
}
function extractTransaction(array $transactionRow):array{
    [$date,$checkNumber,$description,$amount]=$transactionRow;
    $amount=(float) str_replace(['$',','],'',$amount);
    return[
      'date' =>$date,
      'checkNumber'=>$checkNumber,
      'description'=>$description,
      'amount'=>$amount,
    ];
}
function calculateTotals(array $transations):array{
    $totals =['netTotal'=>0,'totalIncome'=>0,'totalExpense'=>0];
   
    foreach($transations as $transation){
        $totals['netTotal'] += $transation['amount'];

        if($transation['amount']>= 0){
            $totals['totalIncome'] += $transation['amount'];
        }else{
            $totals['totalExpense'] += $transation['amount'];
        }

    }
    return $totals;
}