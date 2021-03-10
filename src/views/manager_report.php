<main class="content">
    <?php
        renderTitle(
                'Relatório Gerencial',
              'Resumo das Horas trabalhadas dos funcioários',
                'icofont-chart-histogram'
        );
    ?>
    <div class="sumary-boxes">
        <div class="summary-box bg-primary">
            <i class="icon icofont-users">
            <p class="title"> Quantidade de funcionários</p>
            <h3 class="value"><?= $activeUsersCount ?></h3>
            </i>
        </div>
        <div class="summary-box bg-danger">
            <i class="icon icofont-patient-bed">
                <p class="title"> Faltas</p>
                <h3 class="value"><?= count($absentUsers) ?></h3>
            </i>
        </div>
        <div class="summary-box bg-success">
            <i class="icon icofont-sand-clock">
                <p class="title"> Total de horas no Mês</p>
                <h3 class="value"><?= $hoursInMonth ?></h3>
            </i>
        </div>
    </div>
<!--    lógica para mostrar a tabela somente se existir funcionários faltosos: -->
    <?php if(count($absentUsers) > 0): ?>
    <div class="card mt-4">
       <div class="card-header">
           <h4 class="card-title">Funcionários Faltosos do Dia</h4>
           <p class="card-category mb-0">Funcionários que ainda não bateram ponto</p>
       </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>Nome</th>
                </thead>
                <tbody>
                    <?php foreach ($absentUsers as $name): ?>
                        <tr>
                            <td><?= $name?></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>

        </div>
    </div>
    <?php endif?>
</main>
