<?php
require "arrayPersons.php";
$example_persons_array = example_persons_array();


// объединение ФИО
$surname = 'Иванова';
$name = 'Ивана';
$patronomyc = 'Ивановна';

function getFullnameFromParts($surname, $name, $patronomyc) {
    return $surname . ' ' . $name . ' ' . $patronomyc;
}

// Разделение ФИО

function getPartsFromFullname($fullname) {
    $parts = explode(' ', $fullname);
    return [
        'surname' => $parts[0] ?? '',
        'name' => $parts[1] ?? '',
        'patronomyc' => $parts[2] ?? '',
    ];
}

// Сокращение ФИО

function getShortName($fullname){
    $parts = getPartsFromFullname($fullname);
    $shortName = $parts['name'] . ' ' . mb_substr($parts['surname'], 0, 1) . '.';
    return $shortName;
}


// Функция определения пола по ФИО

function getGenderFrom($fullname){
    $parts = getPartsFromFullname($fullname);
    $gebderScore = 0 ;


    $surname = $parts['surname'];
    $name = $parts['name'];
    $patronomyc = $parts['patronomyc'];



    //  //женщина 
    switch(true){
    case mb_substr($surname, -2) == "ва":
        $gebderScore = -1;
    
    case mb_substr($name, -1) == "a":
        $gebderScore = -1;

    case mb_substr($patronomyc, -3) == "вна":
        $gebderScore= -1;
        break;

    }

    // мужик
    switch(true){
    case mb_substr($surname, -1) == "в":
        $gebderScore = 1;

    case mb_substr($name,-1) == "й":
        $tgebderScore = 1;

    case mb_substr($name,-1) == "н":
        $gebderScore = 1;
    
    case mb_substr($patronomyc, -2) == "ич":
        $gebderScore = 1;
        break; 
    }
    return $gebderScore;
}

function getPerfectPartner($surname, $name, $patronymic, $example_persons_array){
    $person = [];
    $fullname = getFullNameFromParts($name, $surname, $patronymic );
    $getGenderFromName = getGenderFromName($fullname);
    
    //Получаем всеь массив без Job
    foreach($example_persons_array as $item)
    {
        $person[] = $item['fullname'];
    }

    $personAccessGender = [];
    foreach($person as $personGender){
        if($getGenderFromName > 0 && getGenderFromName($personGender) < 0 && getGenderFromName($personGender) != 0){
            $personAccessGender[] = $personGender;
        }
        elseif($getGenderFromName < 0 && getGenderFromName($personGender) > 0 && getGenderFromName($personGender) != 0){
            $personAccessGender[] = $personGender;
        }
    }

    $randPersonFromArray = mt_rand(0, count($personAccessGender)-1);
    echo getShortName($fullname) . ' + ' .getShortName($personAccessGender[$randPersonFromArray]) . ' = <br> ❤ Идеально на ' . mt_rand(50, 100). '% ❤';
}

function calculatePercentage($part, $total) {
    if ($total == 0) {
        return 0; // Избегаем деления на ноль
    }
    return ($part / $total) * 100; 
}

function getGenderDescription($example_persons_array){
    foreach($example_persons_array as $item)
    {
        $person[] = $item['fullname'];
    }

    $women = [];
    $men = [];
    $undefined = [];
    foreach($person as $personGender){
        if(getGenderFromName( $personGender ) > 0){
            $women[] = $personGender;
        }
        elseif(getGenderFromName( $personGender ) < 0){
            $men[] = $personGender;
        }
        elseif( getGenderFromName($personGender) == 0){
            $undefined[] = $personGender;
        }
    }

    $count_example_persons_array = count($example_persons_array);
    $countWomen = count($women);
    $countMen = count($men);
    $countUndefined = count($undefined);

    return [
        'women' => round(calculatePercentage($countWomen, $count_example_persons_array)), 
        'men' => round(calculatePercentage($countMen, $count_example_persons_array)), 
        'undefined' => round(calculatePercentage($countUndefined, $count_example_persons_array)), 
    ];
}
