<?php
session_start();
requireValidSession(true);

//qt de usuários ativos
$activeUsersCount = User::getActiveUsersCount();
//qt usuarios ausentes
$absentUsers = WorkingHours::getAbsentUsers();
//qt de hrs trabalhadas no mes
$yearAndMonth = (new DateTime())->format('Y-m');
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth = explode(':', getTimeStringFromSeconds($seconds))[0];


loadTemplateView('manager_report', [
    'activeUsersCount' => $activeUsersCount,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth,
]);
