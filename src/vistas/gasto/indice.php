<?php
$gastos = getActiveExpenses($pdo);
?>

<div class="well">
  <h3>Gastos activos</h3>

  <?php if (count($gastos) > 0): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Pagador</th>
          <th>Concepto</th>
          <th class="text-right">Importe</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($gastos as $gasto): ?>
          <tr>
            <td><?= e(date('d/m/Y H:i', strtotime($gasto['registration_date']))) ?></td>
            <td><?= e($gasto['nickname']) ?></td>
            <td><?= e($gasto['concept']) ?></td>
            <td class="text-right"><?= e(number_format((float) $gasto['amount'], 2, ',', '.')) ?> €</td>
            <td>
              <form action="<?= RAIZ_URL ?>src/controladores/gasto.php" method="post" style="display: inline-block;"
                    onsubmit="return confirm('¿Seguro que quieres anular este gasto?');">
                <input type="hidden" name="cancelExpense" value="1">
                <input type="hidden" name="fId" value="<?= (int) $gasto['id'] ?>">
                <button type="submit" class="btn btn-sm btn-danger">Anular</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="text-muted">No hay gastos activos.</p>
  <?php endif; ?>
</div>