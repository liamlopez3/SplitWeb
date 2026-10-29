<?php

$usuarios = getAllUsers($pdo);
?>

<div class="well">
    <h3>Nuevo gasto</h3>

    <form action="<?= RAIZ_URL ?>src/controladores/gasto.php" method="post">
        <input type="hidden" name="newExpense" value="1">
        
        <div class="form-group">
            <label for="fPayer">Pagador</label>
            <select id="fPayer" name="fPayer" class="form-control" required>
                <?php foreach($usuarios as $usuario): ?>
                    <option value="<?= e($usuario['email']) ?>"><?= e($usuario['nickname']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fConcept">Concepto</label>
            <input type="text" id="fConcept" name="fConcept" class="form-control"
                    maxlength="100" required>
        </div>

        <div class="form-group">
            <label for="fAmount">Importe (€)</label>
            <input type="number" id="fAmount" name="fAmount" class="form-control"
                    min="0.01" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar gasto</button>
    </form>
</div>