<?php

$usuarios = getAllUsers($pdo);

$errors = $_SESSION['expense_errors'] ?? [];
$formData = $_SESSION['expense_data'] ?? [];
unset($_SESSION['expense_errors'], $_SESSION['expense_data']);
?>

<div class="well">
    <h3>Nuevo gasto</h3>

    <form id="formExpense" action="<?= RAIZ_URL ?>src/controladores/gasto.php" method="post">
        <input type="hidden" name="newExpense" value="1">
        
        <div class="form-group <?= isset($errors['payer']) ? 'has-error' : '' ?> ">
            <label for="fPayer" class="control-label">Pagador</label>
            <select id="fPayer" name="fPayer" class="form-control" required>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= e($usuario['email']) ?>" <?= ($formData['payer'] ?? '') === $usuario['email'] ? 'selected' : '' ?>><?= e($usuario['nickname']) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['payer'])): ?>
                <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['payer']) ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['concept']) ? 'has-error' : '' ?>">
            <label for="fConcept" class="control-label">Concepto</label>
            <input type="text" id="fConcept" name="fConcept" class="form-control"
                maxlength="100" required value="<?= e($formData['concept'] ?? '') ?>">
            <?php if(isset($errors['concept'])): ?>
                <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['concept']) ?></span>
                <?php endif; ?>
            </div>

        <div class="form-group <?= isset($errors['amount']) ? 'has-error' : '' ?>">
            <label for="fAmount" class="control-label">Importe (€)</label>
            <input type="number" id="fAmount" name="fAmount" class="form-control"
                min="0.01" step="0.01" required value="<?= e($formData['amount'] ?? '') ?>">
            <?php if (isset($errors['amount'])): ?>
                <span class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> <?= e($errors['amount']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Registrar gasto</button>
    </form>
</div>