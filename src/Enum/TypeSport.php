<?php
namespace App\Enum;

enum TypeSport: string
{
    case INDIVIDUEL = 'individuel';
    case COLLECTIF = 'collectif';
    case COLL_IND = 'individuel&collectif';

}


